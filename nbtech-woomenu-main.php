<?php

?>
<script>
function nbtech_woomenu_copy_shortcode_to_clip(){
	var shortcode = document.getElementById("nbtech-woomenu-admin-shortcode");
  	shortcode.select();
  	shortcode.setSelectionRange(0, 99999); /* For mobile devices */
  	navigator.clipboard.writeText(shortcode.value);
}
</script>
<style>
	/*#7f54b3*/
	h1{
		font-size: 2em;
	}
	h2{
		font-size: 1.5em;
	}
	h3{
		font-size: 1.2em;
	}
	.nbtech-woomenu-admin-common-wrap{
		border: 1px solid #e2e2e2;
		padding: 4px 16px;
		margin-right: 16px;
	}

	.nbtech-woomenu-admin-content ul{
		list-style-type: circle;
		margin-left: 16px;
	}
	.nbtech-woomenu-admin-icon{
		height: 80px;
		width: 80px;
		margin-top: 16px;
		border-radius: 80px;
	}
	.nbtech-woomenu-admin-button{
		display: inline-block;
		border-radius: 5px;
		background-color: #7f54b3;
		padding: 8px 16px;
		color: #fff;
		text-decoration: none;
		cursor: pointer;
		margin-top: 8px;
		margin-right: 8px;
		border: none;
	}
	.nbtech-woomenu-admin-button:hover{
		background-color: #9a65d9;
		color: #fff;
	}
	.donate{
		background-color: #c776ff;
	}
	.nbtech-woomenu-admin-input[type=text]{
		border-radius: 5px;
		border: 1px solid #7f54b3;
		padding: 4px 8px;
		min-width: 240px;
	}
	.nbtech-woomenu-admin-input[type=text]:focus{
		width: 100%;
	}
</style>
<img class="nbtech-woomenu-admin-icon" src="<?php echo plugin_dir_url( __FILE__ ) . 'images/icon-256x256.png'; ?>" />
<h1>NBTech Woomenu</h1>
<div class="nbtech-woomenu-admin-common-wrap">
	<div class="nbtech-woomenu-admin-content">
		
		<h2>
			<?php _e('Описание', 'nbtech-woomenu'); ?>
		</h2>
		<p>
			<?php _e('Автоматически генерируемое меню категорий и подкатегорий товаров для WooCommerce.', 'nbtech-woomenu'); ?>
		</p>
		<h3>
			<?php _e('Особенности', 'nbtech-woomenu'); ?>
		</h3>
		<p>
			
			<ul>
				<li><?php _e('Формируется динамически из категорий, которые добавлены в раздел "Категории" товаров WooCommmerce', 'nbtech-woomenu'); ?></li>
				<li><?php _e('Для подкатегорий автоматически добавляются изображения, установленные в панели администрирования', 'nbtech-woomenu'); ?></li> 
				<li><?php _e('Адаптивность', 'nbtech-woomenu'); ?></li>
				<li><?php _e('Минимум запросов к базе данных и серверу', 'nbtech-woomenu'); ?></li>
				<li><?php _e('Поддержка переводов', 'nbtech-woomenu'); ?></li>
			</ul>
		</p>
		<p>
			<?php _e('Настройка дизайна в данной версии производится через редактирование файла стилей и код самого плагина. Настройки задаются с помощью параметров шорткода, описание которых ниже.', 'nbtech-woomenu'); ?>
		</p>
		<h3>
			<?php _e('О разработчике', 'nbtech-woomenu'); ?>
		</h3>
		<p class="nbtech-woomenu-admin-info">
			<?php _e('Разработчик', 'nbtech-woomenu'); ?> - Никита Батищев, НБТэк. <br />
			<a href="https://inmysight.ru/it" target="_blank" class="nbtech-woomenu-admin-button"><?php _e('Сайт разработчика', 'nbtech-woomenu'); ?></a> 
			<a href="mailto:info@inmysight.ru" target="_blank" class="nbtech-woomenu-admin-button">Электронная почта</a>
			<a href="https://t.me/nickbtraveler" target="_blank" class="nbtech-woomenu-admin-button">Телеграм</a>
			<a href="https://yoomoney.ru/to/4100116179939783" target="_blank" class="nbtech-woomenu-admin-button donate"><?php _e('Сделать пожертвование', 'nbtech-woomenu'); ?></a>
		</p>
		<hr />
		<h2>
			<?php _e('Шорткод', 'nbtech-woomenu'); ?>
		</h2>
		<p>
			
			<input class="nbtech-woomenu-admin-input" type="text" value="[NBTECH_WOOMENU]" id="nbtech-woomenu-admin-shortcode" readonly="readonly"><br />
			<button class="nbtech-woomenu-admin-button" onclick="nbtech_woomenu_copy_shortcode_to_clip()">
				Скопировать в буфер обмена
			</button>
		</p>
		<p>
			<h3>
			<?php _e('Параметры шорткода', 'nbtech-woomenu'); ?>
			</h3>
		<p>
			<?php _e('Параметры можно добавлять внутрь шорткода, чтобы так или иначе изменять его работу.', 'nbtech-woomenu'); ?><?php _e(' Пример:', 'nbtech-woomenu'); ?> <strong>[NBTECH_WOOMENU show_parent_thumbs=0 show_child_thumbs=1 child_orderby="name"]</strong>
		</p>
			<ul>
				<li>show_parent_thumbs=0 (true, false - <?php _e('отображение картинок у родительских категорий', 'nbtech-woomenu'); ?>)</li>
            	<li>show_child_thumbs=1 (true, false - <?php _e('отображение картинок у дочерних категорий', 'nbtech-woomenu'); ?>)</li>
            	<li>show_brands=1 (true, false - <?php _e('отображение опционального раздела с брендами. Раздел неуниверсален, потому, вероятно, потребует доработки под каждый сайт.', 'nbtech-woomenu'); ?>)</li>
				<li>parent_orderby="none" (term_id, name<?php _e(' и так далее - сортировка родительских категорий по определенному полю', 'nbtech-woomenu'); ?>)</li>
				<li>child_orderby="none" (term_id, name<?php _e(' и так далее - сортировка дочерних категорий по определенному полю', 'nbtech-woomenu'); ?>)</li>
				<li>parent_order="ASC" (ASC, DESC)</li>
				<li>child_order="ASC" (ASC, DESC)</li>
				<li>hide_empty=1 (true, false - <?php _e('скрытие пустых категорий', 'nbtech-woomenu'); ?>)</li>
				<li>placeholder=<?php _e('"полная ссылка на картинку" (картинка-заглушка, когда у категории нет картинки', 'nbtech-woomenu'); ?>)</li>
				<li>mobile_title=<?php _e('"Категории товаров =" (Подпись кнопки раскрытия меню для мобильной версии', 'nbtech-woomenu'); ?>)</li>
				<li>include="2828, 45,13" (<?php _e('Список ID категорий, которые надо оставить. Если пусто, то все категории отображаются. Дочерние категории отображаются только для отображающихся родительских!', 'nbtech-woomenu'); ?>)</li>
				<li>exclude="2828, 45,13" (<?php _e('Список ID категорий, которые надо убрать. Если пусто, то все категории отображаются. Дочерние категории отображаются только для отображающихся родительских!', 'nbtech-woomenu'); ?>)</li>
				<li>brands_taxonomy_slug="brend" (<?php _e('Бета. Если вы включили show_brands, то эта опция будет отвечать и за поиск брендов, и за ссылки на них', 'nbtech-woomenu'); ?>)</li>
			</ul>
			
		</p>
	</div>
</div>