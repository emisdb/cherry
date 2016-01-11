	<?php
	$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
				'ajaxType'=>'post',
				'ajaxUpdate'=>false,
				'template'=>"{items}",
				'viewData'=>array('tnmax'=>$tnmax,'tid'=>$tid),
			));
	?>