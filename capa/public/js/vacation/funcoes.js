// retorna o dia do mês sem o 0
function retornaDiaSemZero(tmp) {
  switch (tmp[2]) {
      case '01':
        tmp[2] = '1';
          break;

      case '02':
        tmp[2] = '2';
          break;

      case '03':
        tmp[2] = '3';
          break;

      case '04':
        tmp[2] = '4';
          break;

      case '05':
        tmp[2] = '5';
          break;

      case '06':
        tmp[2] = '6';
          break;

      case '07':
        tmp[2] = '7';
          break;

      case '08':
        tmp[2] = '8';
          break;

      case '09':
        tmp[2] = '9';
          break;
    }
  
  return tmp;
}

function formataData(data) {
  data = data[0] + '-' + data[1] + '-' + data[2];

  return data.toString();
}