export class Question {
    constructor(id,text,answers) {
        this.id = id;
        this.text = text;
        this.answers = answers;
    }


    showQ(parent) {
        const cardDiv = document.createElement('div')
        const qDiv = document.createElement('div');

        const answersDiv = document.createElement('div');
        const qNode = document.createTextNode(this.text)

        const checkBut = document.createElement('button')
        checkBut.innerText = 'check';
        checkBut.addEventListener('click', this.clickCheck.bind(this))


        cardDiv.appendChild(qDiv);
        qDiv.appendChild(qNode);
        cardDiv.appendChild(answersDiv);

        parent.appendChild(cardDiv);
        parent.appendChild(checkBut);
        for (const answer of this.answers) {
            const ansdiv = document.createElement('div');
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
                    event.target.style = ''
                } else {
                    answer.checked = true
                    event.target.style = 'background-color: blue'
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


};