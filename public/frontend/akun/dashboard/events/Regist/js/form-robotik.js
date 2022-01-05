//js for form-bot.html
const uploadbtn1 = document.getElementById('upload1');
const fileuploaded1 = document.getElementById('fileup1');
uploadbtn1.addEventListener('change', function(){
    fileuploaded1.textContent = this.files[0].name
})

const uploadbtn2 = document.getElementById('upload2');
const fileuploaded2 = document.getElementById('fileup2');
uploadbtn2.addEventListener('change', function(){
    fileuploaded2.textContent = this.files[0].name
})
