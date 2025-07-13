document.addEventListener('DOMContentLoaded', function () {

    console.log('auth');
    const form = document.getElementById('auth-form');

    form.addEventListener('submit', async function (e) {
        e.preventDefault(); // отмена стандартной отправки

        const formData = new FormData(form);
        const csrfToken = document.querySelector('input[name="_token"]').value;

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            });

            if (response.ok) {
                const data = await response.json();
                console.log('Успешно отправлено:', data);
                // Здесь можно, например, показать сообщение об успехе
            } else {
                const error = await response.json();
                console.error('Ошибка:', error);
                // Можно отобразить ошибки на форме
            }
        } catch (err) {
            console.error('Ошибка при запросе:', err);
        }
    });
});
