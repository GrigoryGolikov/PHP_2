<a href="/">Главная</a>
<a href="/product/catalog/">Каталог</a>
<a href="/basket/">Корзина <span id="count"><?php if ($count): ?><?=$count?><?php endif;?></span> </a>
<?php if ($admin): ?>
    <a href="/order/admin/">Администрирование</a>
<?php endif;?>
<br>