document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.public_poll_form').addEventListener('submit', (e) => {
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

        fetch(`http://127.0.0.1:8000/send`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({
                answers: answers,
                shortLink: short_link
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
                document.querySelector('.alert').querySelector('h1').textContent = "Спасибо за прохождение опроса"
                document.querySelector('.send').style.display = 'none'
            })
            .catch(error => {
                console.log(error)
            });
    })
})
