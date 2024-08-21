document.getElementById('userForm').addEventListener('submit', function(event) {
  event.preventDefault(); 

  const staticData = {
    goal_id: 83,
    sub_id1: "traff",
    sub_id2: "fb",
    aff_click_id: "156484efwe4re98b4rev4wr84"
  }

  // Отримання даних з форми
  const firstname = document.getElementById('firstname').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const pixel = document.getElementById('pixel').value;


  //Валідація форми
  let isValid = true;
  let firstnameNotValidMessage = '';
  let phoneNotValidMessage = '';

  if (!firstname) {
    isValid = false;
    firstnameNotValidMessage += 'Name is required';
  }

  const phonePattern = /^[0-9]{10}$/; // Adjust pattern as needed
  if (!phonePattern.test(phone)) {
    isValid = false;
    phoneNotValidMessage += 'Phone number must be 10 digits';
  }

  // Пакування даних у формат JSON
  const dataToSend = JSON.stringify({
    ...staticData,
    firstname,
    phone,
    pixel
  });

  const firstnameErrorElement = document.getElementById('firstname-validation')
  const phoneErrorElement = document.getElementById('phone-validation')

  // Відправка даних на сервер
  if (!isValid) {
    firstnameErrorElement.textContent = firstnameNotValidMessage === '' ? '*' : firstnameNotValidMessage
    phoneErrorElement.textContent = phoneNotValidMessage === '' ? '*' : phoneNotValidMessage
  } else {
    firstnameErrorElement.textContent = '*'
    phoneErrorElement.textContent = '*'
    fetch('solution/api.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: dataToSend
    })
    .then(response => response.json())
    .then(result => {
      if (result.status === 'success') {
        const {firstname, phone, pixel, ...arguments} = result
        const queryParams = new URLSearchParams({firstname, pixel}).toString();
        window.location.assign('solution/success.php?' + queryParams);
      } else {
        console.error('Помилка:', result.message);
      }
    })
    .catch(error => {
      console.error('Помилка при відправці:', error);
    });
  }
});
