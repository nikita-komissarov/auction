<?php

  if(!isset($_POST['entry']) || empty($_POST['entry']) || !is_numeric($_POST['entry'])) exit();

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/server.php';
	use SVG\SVG;

  $entry = R::findOne('stock__items', 'id = ?', [$_POST['entry']]);
  if(!$entry) exit();
  $item = R::findOne('items', 'id = ?', [$entry->item_id]);
  if(!$item) exit();

	$generator = new Picqer\Barcode\BarcodeGeneratorSVG();
	$img = (object)[
		'w' => 270,
		'h' => 200,
		'item_offset' => 170,
		'entry_offset' => 85,
	];
	$item = (object)[
		'id' => $item->id,
		'article' => $item->article,
		'barcode' => $generator->getBarcode($item->article, $generator::TYPE_CODE_128, 2, 50),
	];
	$entry = (object)[
		'id' => $entry->id,
		'article' => $entry->article,
		'barcode' => $generator->getBarcode($entry->article, $generator::TYPE_CODE_128, 2, 50),
	];
	

	$svg  = '<svg width="'.$img->w.'" height="'.$img->h.'">';
  $svg .= 	'<text x="0" style="transform: translate(135px)">';
  $svg .= 		'<tspan x="0" y="20" text-anchor="middle" style="font-size: 20px; letter-spacing: 1.5px; font-weight: bold; font-family: sans-serif;">REUC.MARKET</tspan>';
  $svg .= 		'<tspan x="0" y="'.($img->w - $img->item_offset).'" text-anchor="middle" style="font-size: 16px; font-family: monospace; letter-spacing: 3px;">'.$item->article.'.'.$item->id.'</tspan>';
  $svg .= 		'<tspan x="0" y="'.($img->w - $img->entry_offset).'" text-anchor="middle" style="font-size: 16px; font-family: monospace; letter-spacing: 3px;">'.$entry->article.'.'.$entry->id.'</tspan>';
  $svg .= 	'</text>';
  $svg .= 	'<g id="item-barcode" fill="black" stroke="none">';
	foreach(explode(PHP_EOL, $item->barcode) as $key => $line) {
		if(str_starts_with(trim($line), '<rect')) $svg .= $line;
	}
  $svg .= 	'</g>';
  $svg .= 	'<g id="entry-barcode" fill="black" stroke="none">';
	foreach(explode(PHP_EOL, $entry->barcode) as $key => $line) {
		if(str_starts_with(trim($line), '<rect')) $svg .= $line;
	}
  $svg .= 	'</g>';
	$svg .= '</svg>';

	$svg = SVG::fromString($svg);

	function positionBarcode($id, $offset){
		global $img, $svg;
		$barcode = $svg->getDocument()->getElementById($id);
		$rects = $barcode->getElementsByTagName('rect');
		$width = $rects[count($rects) - 1]->getAttribute('x');
		$width += $rects[count($rects) - 1]->getWidth();
		foreach ($rects as $key => $rect) {
			$rect->setStyle('transform', 'translate('.(($img->w - $width) / 2).'px, '.($img->h - $offset).'px)');
		}
	}
	positionBarcode('item-barcode', $img->item_offset);
	positionBarcode('entry-barcode', $img->entry_offset);

	header('Content-Type: image/svg');
	echo $svg;
?>
