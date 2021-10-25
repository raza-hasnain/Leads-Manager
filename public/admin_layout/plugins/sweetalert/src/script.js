$('#button1').click(function() {
    sweetAlert('Hello World!');
});

$('#button2').click(function() {
    swal('Title...', 'Hello World!');
});

$('#button3').click(function() {
    swal('Title...', 'Hello World!', 'success');
});

$('#button4').click(function() {
    swal('Title...', 'Hello World!', 'info');
});

$('#button5').click(function() {
    swal('Title...', 'Hello World!', 'warning');
});

$('#button6').click(function() {
    swal('Title...', 'Hello World!', 'error');
});

$('#button7').click(function() {
    swal({
        title: '算術題',
        text: '請問1+1等於多少?',
        input: 'text',
        inputPlaceholder: '請輸入答案',
        showCancelButton: true,
        confirmButtonText: '作答',
        cencelButton: '取消',
        closeOnConfirm: false,
        closeOnCancel: false,
    }).then(function (text) {
        if (!text) {
            swal({
                title: '取消',
                text: '這麼簡單的題目，你也不回答嗎？！',
                type: 'warning'
            });
        } else {
            if (+text === 2) {
                swal({
                    title: '答對啦！',
                    text: '你真是天才！',
                    type: 'success'
                });
            } else {
                swal({
                    title: '答錯囉！',
                    text: '再想想看，很簡單的！',
                    type: 'error'
                });
            }
        }
    });
});
