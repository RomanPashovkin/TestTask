document.getElementById('fb-form').addEventListener('submit', function(event){
	event.preventDefault(); //Предотвращение дефолтного поведения формы
	var formData = new FormData(this);

	//Отправление Ajax-запроса
	var request = new XMLHttpRequest();
	request.open('POST', '/formHandler.php', true);
	request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	request.send(formData);

	//Получаем данные из обработчика и выводим в таблице
	request.onload = function() {
		if(request.status === 200) {
			var responce = JSON.parse(request.responseText);
			var table = document.createElement('table');
			table.setAttribute('id', 'result-table');
			
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
				document.getElementById("result").removeChild(document.getElementById("result-table"));
				document.getElementById("result").appendChild(table);
				document.getElementById("result").style.display = 'block';
		}
		else {
			alert('Произошла ошибка. Попробуйте ещё раз.');
		}
	};
	document.getElementById("fb-form").reset();
});