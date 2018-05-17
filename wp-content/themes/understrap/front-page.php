<?php
get_header();
?>

<?php

// задаем нужные нам критерии выборки данных из БД
$args = array(
	'post_type'      => 'pits',
	'posts_per_page' => 5,
    'post_status' => 'publish'
);

$query = new WP_Query( $args );

// Цикл
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		the_post_thumbnail();
		the_title();
		the_content();
		echo get_post_meta(get_the_ID(), 'username', true);
		echo get_post_meta(get_the_ID(), 'email', true);
		echo get_post_meta(get_the_ID(), 'ref-point', true);
	}
} else {
	// Постов не найдено
}
/* Возвращаем оригинальные данные поста. Сбрасываем $post. */
wp_reset_postdata();

?>


<form method="post" enctype="multipart/form-data" id="add_object" class="mt-5 text-center">
    <div class="form-row justify-content-center">
        <div class="form-group col-md-3">
            <input type="text" name="username" id="username" required placeholder="Ваше ім'я (нікнейм):"/>
        </div>
        <div class="form-group col-md-3">
            <input type="email" name="email" id="email" placeholder="Email:" required/>
        </div>
    </div>

    <div class="form-row justify-content-center">
        <div class="form-group col-md-3">
            <input type="text" name="post_title" class="address-input" placeholder="Адреса:" required/>
        </div>
        <div class="form-group col-md-3">
            <input type="text" name="ref-point" class="ref-point-input" placeholder="Орієнтир:" required/>
        </div>
    </div>

    <div class="form-group">
        <textarea name="post_content" id="post_content" placeholder="Опишіть детальніше" required/></textarea>
    </div>

    <div class="form-row justify-content-center">
        <div class="form-group col-md-3">
            <label for="img">Фото:</label>
            <input type="file" name="img" id="img" required/>
        </div>
    </div>

    <input type="submit" name="button" value="Отправить" id="sub"/>
</form>

<div id="output"></div>

<?php
get_footer();
?>
