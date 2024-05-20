document.getElementById('fb-form').addEventListener('submit', function(event){
	event.preventDefault(); //Предотвращение дефолтного поведения формы
	var formData = new FormData(this);
	var table = document.createElement('table');
	table.setAttribute('id', 'result-table');

	//Отправление Ajax-запроса
	var request = new XMLHttpRequest();
	request.open('POST', '/formHandler.php', true);
	request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	request.send(formData);

	//Получаем данные из обработчика и выводим в таблице
	request.onload = function() {
		if(request.status === 400) {
			var data = JSON.parse(request.responseText);
			// Если есть ошибки валидации, показываем их на странице
			if (data.length > 0) {
			var errorsHtml = '<ul>';
			data.forEach(function(error) {
				errorsHtml += '<li>' + error + '</li>';
			});
			errorsHtml += '</ul>';
			document.getElementById("result").removeChild(document.getElementById("result-table"));
			document.getElementById('error').innerHTML = '';
			document.getElementById('thanks').innerHTML = 'Ошибка при отправке формы!';
			document.getElementById('error').innerHTML = errorsHtml;
			document.getElementById("result").appendChild(table);
			document.getElementById("result").style.display = 'block';
		}
		}
		if(request.status === 200) {
		var responce = JSON.parse(request.responseText);
		
		for(let key in responce)
			{
				if(responce.hasOwnProperty(key)) {
					var row = table.insertRow();
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					cell1.innerHTML = key;
					cell2.innerHTML = responce[key];
				}
			}
			document.getElementById('error').innerHTML = '';
			document.getElementById("result").removeChild(document.getElementById("result-table"));
			document.getElementById('thanks').innerHTML = 'Спасибо за обращение!';
			document.getElementById("result").appendChild(table);
			document.getElementById("result").style.display = 'block';
		}

		// else {
		// 	alert('Произошла ошибка. Попробуйте ещё раз.');
		// }
	};
	document.getElementById("fb-form").reset();
});