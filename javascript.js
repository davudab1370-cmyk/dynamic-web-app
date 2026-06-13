
function changeAnswer(commentId , name) {
    var hidden = document.getElementById("answerid");
    hidden.value = commentId;
    var p = document.getElementById("commenttitle");
    p.innerHTML = ` <span>درپاسخ به </span> <strong style="color: firebrick"><small>${name}</small></strong>`
    p.innerHTML += ' دیدگاهی بنویسید ';
    cancel = document.createElement('span');
    cancel.innerHTML = "لغو پاسخ";
    cancel.style.backgroundColor = "darkblue";
    cancel.style.color = "white";
    cancel.style.padding = "5px 8px";
    cancel.style.margin = "0px 20px";
    cancel.style.cursor = "pointer";
    cancel.style.fontSize = "16px";
    cancel.style.fontFamily = "'B Yekan'";
    cancel.addEventListener('click', function () {
        var hidden = document.getElementById("answerid");
        hidden.value = 0;
        var p = document.getElementById("commenttitle");
        p.innerHTML = "دیدگاه خود را در مورد این مطلب بنویسید.";
    });
    p.appendChild(cancel);
    location.href = "#sendcomment";
}

function checkSignup(){
    var first = document.getElementById("first");
    var last = document.getElementById("last");
    var user = document.getElementById("user");
    var email = document.getElementById("email");
    var pass1 = document.getElementById("pass1");
    var pass2 = document.getElementById("pass2");
    if(first.value.length == 0){
        alert("لطفاً نام خود را وارد کنید.");
        first.focus();
        return false;
    }else if(last.value.length == 0){
        alert("لطفاً نام خانوادگی خود را وارد کنید.");
        last.focus();
        return false;
    }else if(user.value.length < 3){
        alert("نام کاربری حداقل باید 3 کاراکتر باشد.");
        user.focus();
        return false;
    }else if(email.value.length == 0){
        alert("وارد کردن یک ایمیل معتبر اجباری است.");
        email.focus();
        return false;
    }else if(pass1.value.length < 6){
        alert("کلمه عبور حداقل باید 6 کاراکتر باشد.");
        pass1.focus()
        return false;
    }else if(pass1.value != pass2.value){
        alert("دو کلمه عبور یکسان نیستند");
        pass1.focus();
        return false;
    }else
        return true;
}