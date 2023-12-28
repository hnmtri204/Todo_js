// var todoList = [];
// $(document).ready(function(){
//   var json = localStorage.getItem('todoList');
//   if (json!=null){
//     todoList = JSON.parse(json)
//   }
//   render()
// });

// window.addEventListener('beforeunload', function(e){
//   this.localStorage.setItem('todoList', JSON.stringify(todoList))
// });

// function addTodo() {
//   let domTask = document.getElementById("task");
//   let domtimeBegin = document.getElementById("timeBegin");
//   let domtimeEnd = document.getElementById("timeEnd");

//   let taskName = domTask.value;
//   let timeBegin = domtimeBegin.value;
//   let timeEnd = domtimeEnd.value;

//   var todo = {
//     taskName: taskName,
//     timeBegin: timeBegin,
//     timeEnd: timeEnd,
//   };

//   todoList.push(todo);

//   render();
//   alert('Đã lưu thành công');
//   //   console.log(todoList);
//   taskInput.value = "";
//   timeBeginInput.value = "";
//   timeEndInput.value = "";
// }

// function render() {
//   let domTodoList = document.getElementById("todoList");
//   let htmlTodoList = "";
//   for (let i = 0; i < todoList.length; i++) {
//     let todo = todoList[i];
//     htmlTodoList +=
//     `<tr>` +`<th scope="row">` +(i + 1) +`</th>` +
//     `<td>` +todo.taskName +`</td>` +
//     `<td>` +todo.timeBegin +`</td>` +
//     `<td>` +todo.timeEnd +`</td>` +
//     `<td><input type="checkbox" checked></td>
//      <td class="primary"><button onclick="editTask(${i})">Sửa</button></i></td>
//      <td class="danger"><button onclick="deleteTask(${i})">Xóa</button></td>
//     </tr>`;
//   }
//   domTodoList.innerHTML = "";
//   domTodoList.innerHTML = htmlTodoList;
// }
// //Edit todo list
// function editTask(index) {
//   let todo = todoList[index];
//   let newTaskContent = prompt("Nhập nội dung công việc mới:");
//   let newtimeBegin = prompt("Nhập ngày bắt đầu mới:", todo.timeBegin);
//   let newtimeEnd = prompt("Nhập ngày kết thúc mới:", todo.timeEnd);
//   if (newTaskContent !== null && newtimeBegin !== null && newtimeEnd !== null) {
//     todo.taskName = newTaskContent;
//     todo.timeBegin = newtimeBegin;
//     todo.timeEnd = newtimeEnd;

//     render();
//   }
// }
// function deleteTask(index) {
//   todoList.splice(index, 1);
//   render();
// }
// render();

  var todoList = [];
  $(document).ready(function(){
    var json = localStorage.getItem('todoList');
    if (json!=null){
      todoList = JSON.parse(json)
    }
    render()
  });
  
  window.addEventListener('beforeunload', function(e){
    this.localStorage.setItem('todoList', JSON.stringify(todoList))
  });

  $('#addTodo').click(function () {
    var taskName = $('#task').val();
    var timeBegin = $('#timeBegin').val();
    var timeEnd = $('#timeEnd').val();

    var todo = {
      taskName: taskName,
      timeBegin: timeBegin,
      timeEnd: timeEnd,
    };

    todoList.push(todo);

    render();
    alert('Đã lưu thành công');

    $('#task').val('');
    $('#timeBegin').val('');
    $('#timeEnd').val('');
  });

  function render() {
    var $todoList = $('#todoList');
    $todoList.empty();

    for (var i = 0; i < todoList.length; i++) {
      var todo = todoList[i];

      var row = '<tr>' +
        '<td>' + (i + 1) + '</td>' +
        '<td>' + todo.taskName + '</td>' +
        '<td>' + todo.timeBegin + '</td>' +
        '<td>' + todo.timeEnd + '</td>' +
        '<td style="text-align: center;">' + '<input type="checkbox" checked>' +'</td>' +
        '<td style="text-align: center;" class="primary">' + '<button class="editButton">Sửa</button>' + '</td>' +
        '<td style="text-align: center;" class="danger">' + '<button class="deleteButton">Xóa</button>' + '</td>' +
        '</tr>';

      $todoList.append(row);
    }

    $('.editButton').click(function () {
      var index = $(this).closest('tr').index();
      editTask(index);
    });

    $('.deleteButton').click(function () {
      var index = $(this).closest('tr').index();
      deleteTask(index);
    });
  }

  function editTask(index) {
    var todo = todoList[index];
    var newTaskContent = prompt('Nhập nội dung công việc mới:', todo.taskName);
    var newTimeBegin = prompt('Nhập ngày bắt đầu mới:', todo.timeBegin);
    var newTimeEnd = prompt('Nhập ngày kết thúc mới:', todo.timeEnd);

    if (newTaskContent !== null && newTimeBegin !== null && newTimeEnd !== null) {
      todo.taskName = newTaskContent;
      todo.timeBegin = newTimeBegin;
      todo.timeEnd = newTimeEnd;

      render();
    }
  }

  function deleteTask(index) {
    todoList.splice(index, 1);
    render();
  }

  render();
