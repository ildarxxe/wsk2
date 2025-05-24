document.addEventListener('DOMContentLoaded', () => {
    const form = document.forms[0];
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const answers = {}

        document.querySelectorAll('input[type="radio"]:checked').forEach(input => {
            const questionId = input.name;
            const answerId = input.value;
            answers[questionId] = [answerId]
        })

        document.querySelectorAll('input[type="checkbox"]:checked').forEach(input => {
            const questionId = input.name;
            const answerId = input.value;
            if (!answers[questionId]) {
                answers[questionId] = [];
            }
            answers[questionId].push(answerId);
        })

        const short_link = window.location.pathname.split('/').pop();
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

        fetch(`http://127.0.0.1:8000/${short_link}/send-poll`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({
                answers: answers
            })
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw new Error(errorData.message || 'Server error', { cause: errorData });
                    });
                }
                return response.json();
            })
            .then(data => {
                document.querySelector('.alert').querySelector('h2').textContent = "Успешно! Спасибо за прохождение!"
                document.querySelector('.send').style.display = 'none'
            })
            .catch(error => {
                console.log(error)
            });
    })
})
