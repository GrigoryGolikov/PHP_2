<?php if ($admin): ?>
    <h2>Админка</h2>

    <?php foreach ($orders as $item):?>
        <div id="item_<?=$item['id']?>">
            <div>
                <p> Имя <span><?=$item['name'].' '?></span></p>
                <p> телефон: <span><?=$item['phone'].' '?></span></p>
                <p> email: <span><?=$item['email'].' '?></span></p>
                <p> адрес: <span><?=$item['address'].' '?></span></p>

                <?php if ($item['status_id'] == 1): ?>
                    <p> статус: <span>Новый</span></p>
                <?php elseif ($item['status_id'] == 2): ?>
                    <p> статус: <span>Формируется</span></p>
                <?php elseif ($item['status_id'] == 3): ?>
                    <p> статус: <span>Закрыт</span></p>
                <?php endif;?><br>

                <a href="/order/Details/?id=<?=$item['id']?>">Детали заказа</a>
            </div>
        </div>
        <br><hr>
    <?php endforeach;?>
    <br>

<?php endif; ?>

