document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems);
});

document.addEventListener('DOMContentLoaded', function() {
  const testTypeSelect = document.getElementById('testTypeSelect');
  const testProtocolSelect = document.getElementById('testProtocolSelect');

  testTypeSelect.addEventListener('change', function() {
      const selectedValue = this.value;

      document.getElementById('simpleDiv').style.display = 'none';
      document.getElementById('multipleDiv1').style.display = 'none';
      document.getElementById('multipleDiv2').style.display = 'none';

      if (selectedValue === '1') {
          document.getElementById('simpleDiv').style.display = 'block';
      } else if (selectedValue === '2') {
          document.getElementById('multipleDiv1').style.display = 'block';
      } else if (selectedValue === '3') {
          document.getElementById('multipleDiv2').style.display = 'block';
      }
  });

  testProtocolSelect.addEventListener('change', function() {
    const selectedValue = this.value;

    document.getElementById('testMethodSelectHttp').hidden = true
    document.getElementById('testMethodSelectOthers').hidden = true

    if (selectedValue === 'HTTP') {
      document.getElementById('testMethodSelectHttp').hidden = false
    } else if (selectedValue === 'OTHERS') {
        document.getElementById('testMethodSelectOthers').hidden = false
    } 
  });
});