export class Question {
    constructor({id,text,answers}) {
        this.id = id;
        this.text = text;
        this.answers = answers;
    }


    showQ(parent) {
        const cardDiv = document.createElement('div')
        cardDiv.classList.add('card')
        const qDiv = document.createElement('div');

        const answersDiv = document.createElement('div');
        answersDiv.className = 'answersContainer'
        const qNode = document.createTextNode(this.text)

        const checkBut = document.createElement('button')
        checkBut.innerText = 'check';
        checkBut.addEventListener('click', this.clickCheck.bind(this))


        cardDiv.appendChild(qDiv);
        cardDiv.appendChild(answersDiv);

        qDiv.appendChild(qNode);

        parent.appendChild(cardDiv);
        cardDiv.appendChild(checkBut);
        for (const answer of this.answers) {
            const ansdiv = document.createElement('div');
            ansdiv.classList.add('answer');

            const ansTxtNode = document.createTextNode(answer.text);
            ansdiv.id = 'answerId_' + answer.id;
            ansdiv.addEventListener('click', this.clickAns.bind(this))
            ansdiv.appendChild(ansTxtNode);
            answersDiv.appendChild(ansdiv);
        }


    }

    clickAns(event) {
        const id = event.target.id.replace("answerId_", '')

        for (const answer of this.answers) {
            console.log(answer)
            if (answer.id === parseInt(id)) {
                if (answer.checked) {
                    answer.checked = false
                    event.target.className = 'answer';
                } else {
                    answer.checked = true
                    event.target.className = 'answerChecked';

                }
            }
        }
    }

    checkAns() {
        for (const answer of this.answers) {
            if (answer.checked !== answer.correct) {
                return false
            }
        }
        return true
    }

    clickCheck() {
        if (this.checkAns()) {
            alert('richtig');
        } else {
            alert('Falsch');
        }
    }
}