<?php if ($admin): ?>

    <h2>Детали заказа</h2>

    <p> Имя <span><?=$order->name.' '?></span></p>
    <p> телефон: <span><?=$order->phone.' '?></span></p>
    <p> адрес: <span><?=$order->address.' '?></span></p>
    <p> статус: <span><?=$order->status_id.' '?></span></p>

    <select id="status">
        <option value="1" <?php if ($order->status_id == 1): ?> selected <?php endif; ?>>Новый</option>
        <option value="2" <?php if ($order->status_id == 2): ?> selected <?php endif; ?>>Формируется</option>
        <option value="3" <?php if ($order->status_id == 3): ?> selected <?php endif; ?>>Закрыт</option>
    </select>
    <br><br>
    <h2 id="status-change">
    </h2>
    <div class="order">
        <button id="order-save" class="save" data-id="<?=$order->id?>">Сохранить</button><br>
    </div>

    <hr>
<?php foreach ($basket as $item):?>
    <div id="item_<?=$item['basket_id']?>">
        <?=$item['name']?> <br>
        <img src="/img/<?= $item['image'] ?>" width="150">
        <br>

        Цена: <?=$item['price']?>  <br>
    </div><hr>
<?php endforeach;?>
<br>
<br><br>
<?php endif; ?>

<script src="/js/order.js"></script>
