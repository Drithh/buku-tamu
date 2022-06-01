const deleteRow = async (id, event) => {
  event.preventDefault();
  const res = await fetch(`delete-row.php?id=${id}`);
  const data = await res.text();
  setTableData();
  setTimeout(() => {
    alert(data);
  }, 100);
};

const addRow = async (event) => {
  event.preventDefault();
  const res = await fetch('insert-row.php', {
    method: 'POST',
    body: new FormData(document.querySelector('#form')),
  });
  const data = await res.text();
  setTableData();

  setTimeout(() => {
    alert(data);
  }, 100);
};

window.onload = async function () {
  await setTableData();
};

const setTableData = async () => {
  const res = await fetch('table-data.php');
  const data = await res.text();
  document.querySelector('#table-body').innerHTML = data;
  document.querySelector('#id').innerHTML = parseInt(
    document.querySelector('#last-id').getAttribute('last-id')
  );
  clearInput();
};

const clearInput = (event) => {
  if (event) {
    event.preventDefault();
  }
  document.querySelectorAll('input').forEach((input) => {
    input.value = '';
  });
  document.querySelector('input#date').value = new Date()
    .toLocaleString('sv-SE')
    .replace(' ', 'T');
};

const editRow = (el) => {
  const id = el.querySelector('div.id').innerHTML.trim();
  const data = [...el.querySelectorAll('.data')].map((el) =>
    el.innerHTML.trim()
  );

  el.querySelectorAll('div').forEach((el) => {
    el.classList.add('hidden');
  });
  el.innerHTML += document.querySelector('#form').innerHTML;
  el.querySelector('div#id').innerHTML = id;
  el.querySelectorAll('input').forEach((input, i) => {
    if (input.type === 'datetime-local') {
      input.value = data[i].replace(' ', 'T');
    } else {
      input.value = data[i];
    }
  });
  el.querySelector('button.check').setAttribute(
    'onclick',
    `confirmEditRow(this.parentElement.parentElement, ${id}, event)`
  );
  el.querySelector('button.cancel').setAttribute(
    'onclick',
    'cancelEditRow(this.parentElement.parentElement)'
  );
};

const confirmEditRow = async (el, id, event) => {
  event.preventDefault();
  const formData = new FormData(el);
  formData.append('id', id);
  const res = await fetch(`edit-row.php`, {
    method: 'POST',
    body: formData,
  });
  const data = await res.text();
  setTableData();

  setTimeout(() => {
    alert(data);
  }, 100);
};

const cancelEditRow = (el) => {
  el.querySelectorAll('div:not(.hidden)').forEach((el) => {
    el.remove();
  });
  el.querySelectorAll('div.hidden').forEach((el) => {
    el.classList.remove('hidden');
  });
};

let sortTableProperties = {
  column: 'ID',
  direction: 'asc',
};

const sortTable = async (column) => {
  if (sortTableProperties.column === column) {
    sortTableProperties.direction =
      sortTableProperties.direction === 'asc' ? 'desc' : 'asc';
  } else {
    sortTableProperties.column = column;
    sortTableProperties.direction = 'asc';
  }
  const res = await fetch(
    `table-data.php?column=${column}&direction=${sortTableProperties.direction}`
  );
  const data = await res.text();
  document.querySelector('#table-body').innerHTML = data;
};
