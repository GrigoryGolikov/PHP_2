<h2 id="text-basket">
    <?php if ($sum):?>
        Корзина
    <?php else:?>
        Корзина пуста
    <?php endif;?>
</h2>
<?php foreach ($basket as $item):?>
    <div class = "div-Basket" id="item_<?=$item['basket_id']?>">
        <a href="/product/card/?id=<?=$item["good_id"]?>">
            <?=$item['name']?> <br>
            <img width="50" src="/img/<?=$item["image"]?>"><br>
            <br>
            Цена: <?=$item['price']?>  <br>
        </a>
        <button type="button"  class="delete" data-id="<?=$item['basket_id']?>">Удалить</button><hr>
    </div>
<?php endforeach;?>

<?php if ($sum):?>
    <div id = "div-order">
        Общая стоимость: <span id="sum"><?=$sum?></span><br>
        <h2>Оформите заказ</h2>
        <form action="/order/" method="post" id="form-order">
            <input placeholder="Ваше имя" type="text" name="name" id = "name">
            <input placeholder="Телефон" type="text" name="phone" id="phone">
            <input placeholder="email" type="text" name="email" id="email">
            <input placeholder="Адрес доставки" type="text" name="address" id="address">
            <button type="button" id="Add-Order" > Оформить заказ </button>
        </form>
    </div>

    <h2 id="order-ok">
    </h2>

    <script src="/js/basket.js"></script>

<?php endif;?>

