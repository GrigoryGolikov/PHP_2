let button = document.getElementById('order-save');

button.addEventListener('click', () => {
    let id = button.getAttribute('data-id');
    let status = document.getElementById("status").value;
    (
        async () => {
            const response = await fetch('/order/save/', {
                method: 'POST',
                headers: new Headers({
                    'Content-Type': 'application/json'
                }),
                body: JSON.stringify({
                    id: id,
                    status: status,
                })
            });
            document.getElementById("status-change").innerText = "Изменения сохранены";

        }
    )();
});

let input = document.getElementById("status");

input.addEventListener('change', () => {
    document.getElementById("status-change").innerText = "Статус был изменен. Сохранить?";
});