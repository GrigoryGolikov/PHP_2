let buttonsDel = document.querySelectorAll('.delete');

buttonsDel.forEach((elem) => {
    elem.addEventListener('click', () => {
        let id = elem.getAttribute('data-id');
        //console.log(id);
        (
            async () => {
                const response = await fetch('/basket/DeleteToBasket/', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        id: id,
                    })
                });
                const answer = await response.json();
                elem.parentElement.remove();
                document.getElementById('count').innerText = answer.count==0 ? '' : answer.count;
                document.getElementById('sum').innerText = answer.sum;
                if (! answer.sum){
                    document.getElementById('div-order').remove();
                    document.getElementById('text-basket').innerText = 'Корзина пуста';
                }
            }
        )();
    })
});

let buttonOrder = document.getElementById('Add-Order');

buttonOrder.addEventListener('click', () => {
    let name = document.getElementById("name").value;
    let phone = document.getElementById("phone").value;
    let email = document.getElementById("email").value;
    let address = document.getElementById("address").value;
    (
        async () => {
            const response = await fetch('/order/', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        name: name,
                        phone: phone,
                        email: email,
                        address: address,

                    })
                });
            const answer = await response.json();
            console.log(answer);
            if (answer.response ="ok"){
                let div = document.querySelectorAll('.div-Basket');
                div.forEach((elem) => { elem.remove()});
                buttonOrder.parentElement.remove();
                document.getElementById('count').innerText = answer.count==0 ? '' : answer.count;
                document.getElementById('div-order').remove();
                document.getElementById('order-ok').innerText = "Заказ оформлен";
                document.getElementById('text-basket').innerText = 'Корзина пуста';
            }
        }
    )();
});