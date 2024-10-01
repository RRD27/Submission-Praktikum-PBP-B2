function getXMLHttpRequest() {
  if (window.XMLHttpRequest) {
   
    return new XMLHttpRequest();
  } else {
    
    return new ActiveXObject('Microsoft.XMLHTTP');
  }
}
const checkPhone = () => {
  let inner = 'error_phone_number';
  let phone_number = encodeURI(document.getElementById('phone_number').value);
  let url = './utils/get_order.php?phone_number=' + phone_number;

  let xhr = getXMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText === 'used') {
        document.getElementById(inner).innerText = 'Nomor Telepon sudah digunakan';
      } else {
        document.getElementById(inner).innerText = '';
      }
    }
  };
  xhr.open('GET', url, true);
  xhr.send();
};

const getModel = (brand_code) => {
  let inner = 'model';
  let url = './utils/get_model.php?brand_code=' + brand_code;

  let xhr = getXMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById(inner).innerHTML = xhr.responseText;
    }
  };
  xhr.open('GET', url, true);
  xhr.send();
};

const validateAndCheckDuplicates = (callback) => {
  const name = document.getElementById('name').value;
  const phone_number = document.getElementById('phone_number').value;
  const address = document.getElementById('address').value;
  const brand = document.getElementById('brand').value;
  const model = document.getElementById('model').value;
  const colorRadio = document.getElementsByName('color');

  let color;
  for (let i = 0; i < colorRadio.length; i++) {
    if (colorRadio[i].checked) {
      color = colorRadio[i].value;
      break;
    }
  }

  
  let hasError = false;
  if (!name) {
    document.getElementById('error_name').innerText = 'Nama harus diisi';
    hasError = true;
  } else {
    document.getElementById('error_name').innerText = '';
  }
  if (!phone_number) {
    document.getElementById('error_phone_number').innerText = 'Nomor Telepon harus diisi';
    hasError = true;
  } else {
    document.getElementById('error_phone_number').innerText = '';
  }
  if (!address) {
    document.getElementById('error_address').innerText = 'Alamat harus diisi';
    hasError = true;
  } else {
    document.getElementById('error_address').innerText = '';
  }
  if (!brand) {
    document.getElementById('error_brand').innerText = 'Merek harus dipilih';
    hasError = true;
  } else {
    document.getElementById('error_brand').innerText = '';
  }
  if (!model) {
    document.getElementById('error_model').innerText = 'Model harus dipilih';
    hasError = true;
  } else {
    document.getElementById('error_model').innerText = '';
  }
  if (!color) {
    document.getElementById('error_color').innerText = 'Warna harus dipilih';
    hasError = true;
  } else {
    document.getElementById('error_color').innerText = '';
  }

  if (hasError) {
    return;
  }

 
  let xhr = getXMLHttpRequest();
  let url = './utils/add_order.php';
  let params =
    'name=' +
    encodeURIComponent(name) +
    '&phone=' +
    encodeURIComponent(phone_number) +
    '&address=' +
    encodeURIComponent(address) +
    '&brand=' +
    encodeURIComponent(brand) +
    '&model=' +
    encodeURIComponent(model) +
    '&color=' +
    encodeURIComponent(color);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.status === 'error') {
        if (response.message === 'Data sudah ada') {
          document.getElementById('error_name').innerText = 'Nama sudah digunakan';
          document.getElementById('error_phone_number').innerText = 'Nomor Telepon tidak tersedia';
          document.getElementById('error_address').innerText = 'Alamat sudah digunakan';
        } else {
          alert(response.message);
        }
      } else {
        callback();
      }
    }
  };
  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send(params);
};

const addOrder = () => {
  validateAndCheckDuplicates(() => {
    const name = document.getElementById('name').value;
    const phone_number = document.getElementById('phone_number').value;
    const address = document.getElementById('address').value;
    const brand = document.getElementById('brand').value;
    const model = document.getElementById('model').value;
    const colorRadio = document.getElementsByName('color');

    let color;
    for (let i = 0; i < colorRadio.length; i++) {
      if (colorRadio[i].checked) {
        color = colorRadio[i].value;
        break;
      }
    }

    let xhr = getXMLHttpRequest();
    let url = './utils/add_order.php';
    let params =
      'name=' +
      encodeURIComponent(name) +
      '&phone=' +
      encodeURIComponent(phone_number) +
      '&address=' +
      encodeURIComponent(address) +
      '&brand=' +
      encodeURIComponent(brand) +
      '&model=' +
      encodeURIComponent(model) +
      '&color=' +
      encodeURIComponent(color);

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.status === 'success') {
          alert('Data berhasil disimpan');
        } else {
          alert('Kolom harus diisi');
        }
      }
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(params);
  });

  return false; 
};