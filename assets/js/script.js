carets = document.getElementsByClassName('caret');

for (var i = 0; i < carets.length; i++) {
    carets[i].addEventListener('click', function() {
        this.classList.toggle('caret-down')
        parent = this.parentElement;
        parent.querySelector('.nested').classList.toggle('active')
    })
}


createParent = document.getElementById('createParent')
backend = document.getElementById('backend')
createParent.addEventListener('click', function() {

    backend.innerHTML += ` <li>
    <input type="text" value='Parent'>
    <button class='createChild'><i class="fa fa-sitemap" aria-hidden="true"></i></button>
    <span class='closeIT'>X</span>
</li>`
})

backend.addEventListener('click', function(e) {
    if (e.target.classList == 'closeIT') {
        e.target.parentElement.remove();
    }

    if (e.target.classList == 'createChild') {
        createChildBTN = e.target;
        li = createChildBTN.parentElement;
        count = prompt('Enter the Number of Row');
        var x = '';
        for (var i = 1; i <= count; i++) {
            x += ` <li>
            <input type="text" value='Child'>
            <button class='createGrandChild'><i class="fa fa-sitemap" aria-hidden="true"></i></button>
            <span class='closeIT'>X</span>
        </li>`
        }

        li.innerHTML += `<ul>${x}</ul>`;

    }

    if (e.target.classList == 'createGrandChild') {
        createChildBTN = e.target;
        li = createChildBTN.parentElement;
        count = prompt('Enter the Number of Row');
        var x = '';
        for (var i = 1; i <= count; i++) {
            x += ` <li>
            <input type="text" value='Grand Child'>
            <button class='createGreatGrandChild'><i class="fa fa-sitemap" aria-hidden="true"></i></button>
            <span class='closeIT'>X</span>
        </li>`
        }

        li.innerHTML += `<ul>${x}</ul>`;

    }

    if (e.target.classList == 'createGreatGrandChild') {
        createChildBTN = e.target;
        li = createChildBTN.parentElement;
        count = prompt('Enter the Number of Row');
        var x = '';
        for (var i = 1; i <= count; i++) {
            x += ` <li>
            <input type="text" value='Great Grand Child'>
           
            <span class='closeIT'>X</span>
        </li>`
        }

        li.innerHTML += `<ul>${x}</ul>`;

    }


})

