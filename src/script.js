//Получение элемента по его идентификатору
function ById(id)
{
	return document.getElementById(id);
}

// Валидация полей формы
function Validation(element)
{
	var errorList = [];
	
	//Если все поля заполнены - активируется кнопка отправки формы
	checkButton();
	switch (element.id.toLowerCase())
				 {
					 case "login" :
									if (element.value == "" || element.value.length < 2) errorList.push(5);
						            break; 
					case "loginreg" :
									if (element.value == "" || element.value.length < 2) errorList.push(5);
						            break; 				
					 case "lastloginreg" :
									if (element.value == "" || element.value.length < 2) errorList.push(1); 
										break;
					 case "pass" :
									if (element.value == "" || element.value.length < 6) errorList.push(3);
									break;
					case "passreg" :
									if (element.value == "" || element.value.length < 6) errorList.push(3);
									break;
					case  "twopassreg":
									if (element.value == "" || element.value.length < 6) errorList.push(3);
									if(element.value != ById("passreg").value) errorList.push(6);
									break;				
					 case "emailreg" : 
									var re = /^((\"[^\"\f\n\r\t\v\b]+\")|([\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+(\.[\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+)*))@((\[(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))\])|(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|((([A-Za-z0-9\-])+\.)+[A-Za-z\-]+))$/;
									if (element.value == "" || !re.test(element.value)) errorList.push(2);
									break;	
					 default :
								break;
				 }
	return errorList;
} 

function checkFormLogin(id)
{
 // Заранее объявим необходимые переменные
 var login, pass;
 
 // Хэш с текстом ошибок (ключ - ID ошибки)
 var errorText = { 
			1 : "Не заполнено поле 'Имя пользователя'",
			2 : "Неправильно введен 'E-mail'", 
			3 : "Неправильно введен пароль",
			4 : "Не оставлен комментарий",
			5 : "Не заполнено поле 'Имя/логин'",
			6 : "Не совпадает введеный пароль с подтвержденным"
 };
 
 //Массив ошибок
 var errorList =[];

 element = ById(id);
 errorList = Validation(element);
 // Если массив ошибок пуст - возвращаем true 
 if (!errorList.length) return true;

 // Если есть ошибки - формируем сообщение, выводим alert и возвращаем false 
 var errorMsg = "";
 for (i = 0; i < errorList.length; i++)
   { 
	errorMsg += errorText[errorList[i]] + "\n";
   }
 // Здесь формируется содержимое и выводится блок информирующий об ошибке
 changing_content(id, errorMsg);
 return false; 
}

// Активация кнопки
function checkButton()
{
	ById("button_login").disabled = true;
	if(ById("loginForm"))
	{
		if(ById("login").value!="" && ById("pass").value!="")	ById("button_login").disabled = false;
	}
	else
	{
		if(ById("loginreg").value!="" && ById("passreg").value!="" && ById("emailreg").value!="" && (ById("passreg").value == ById("twopassreg").value))	ById("button_login").disabled = false;
	}
}

// Выводим сообщение об ошибке ввода
function changing_content(id, errorMsg)
{
	ById(id+"_content").innerHTML= errorMsg;
	ById(id+"_content").display = "inline-block";
	var timerId = setTimeout(function(){ ById(id+"_content").display = "none"; ById(id+"_content").innerHTML= ""; clearTimeout(timerId);},1500);
}

//Установка языка по умолчанию в select name=sel_lang
function sel_lang(id)
{
	if(id == "EN")
	{	
		ById("EN").selected=true;
		ById("RU").selected=false;
	}
	else
	{
		ById("EN").selected=false;
		ById("RU").selected=true;
	}
}

//Формирование изображения в тэге option
function changeImage(img, idelem){
    if(document.getElementById(idelem)){
        document.getElementById(idelem).src = img;
    }
}

function getName (str){
    if (str.lastIndexOf('\\')){
        var i = str.lastIndexOf('\\')+1;
    }
    else{
        var i = str.lastIndexOf('/')+1;
    }						
    var filename = str.slice(i);			
    var uploaded = document.getElementById("fileformlabel");
    uploaded.innerHTML = filename;
}