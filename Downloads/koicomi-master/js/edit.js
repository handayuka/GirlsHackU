// 縦書きにするために
var tategaki = function(context, text, x, y) {
    var textList = text.split('\n');
    var lineHeight = context.measureText("あ").width;
    textList.forEach(function(elm, i) {
	Array.prototype.forEach.call(elm, function(ch, j) {
	    context.fillText(ch, x-lineHeight*i, y+lineHeight*j);
	});
    });
};

//クリックした時の反応
canvas.click(function(e) {
    var pos;
    // to do error check  
    // draw text
    pos = getMousePosition(e, canvas.get(0));
    if(flag == 0){
        drawText(pos);
    }
    else if (flag == 1) {
        drawImage(pos);
    }
});

//textを書く
function drawText(pos) {
    var text, size, color;
    
    text = $('#text').val();
    size = $('#size').val();
    color = $('#color').val();
    
    text = (text === '') ? 'Example' : text;
    color = (color === '') ? '#000' : color;
    size = (size === '') ? '14px' : parseInt(size, 10) + 'px';
    
    cxt.clearRect(0, 0, canvas.width, canvas.height);
    
    cxt.font = size + ' "Hiragino Maru Gothic ProN2","Tsukushi A Round Gothic","メイリオ","sans-serif"';
    cxt.fillStyle = color;
    tategaki(cxt, text,  pos.x, pos.y);
    //cxt.fillText(text, pos.x, pos.y);
    cPush();
    
}

// クリックした場所を得る
function getMousePosition(mouseEvent, targetCanvas) {
    var x, y;
    if (mouseEvent.pageX != undefined && mouseEvent.pageY != undefined) {
        x = mouseEvent.pageX;
        y = mouseEvent.pageY;
    } else {
        x = mouseEvent.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
        y = mouseEvent.clientY + document.body.scrollTop + document.documentElement.scrollTop;
    }
    
    return {
        x: x - targetCanvas.offsetLeft,
        y: y - targetCanvas.offsetTop
    };
}

//hintに関して
$('.open').click(function() {
    $("#panel").animate({
        width: 'toggle'
    }, 500);
});


//undoに関して
var cPushArray = new Array();
var cStep = -1;

function cPush() {
    cStep++;
    if (cStep < cPushArray.length) { cPushArray.length = cStep; }
    cPushArray.push(document.getElementById('canvas').toDataURL());
}
function cUndo() {
    if (cStep > 0) {
        cStep--;
        var canvasPic = new Image();
        canvasPic.src = cPushArray[cStep];
        canvasPic.onload = function () { cxt.drawImage(canvasPic, 0, 0); }
    }
    if (cStep == 0) {
        clear();
    }
}


//画面の行き来
function toStampFromText(){
    flag=1;
    $('#edit').css('display', 'none');
    $('#nav_edit').css('display', 'none');
    $('#toStamp').css('display', 'none');
    $('#stamp').css('display', 'block');
    $('#chgImg').css('display', 'block');
    $('#nav_stamp').css('display', 'block');
}
function toTextFromStamp(){
    flag=0;
    $('#edit').css('display', 'block');
    $('#nav_edit').css('display', 'block');
    $('#toStamp').css('display', 'block');
    $('#nav_stamp').css('display', 'none');
    $('#stamp').css('display', 'none');
    $('#chgImg').css('display', 'none'); 
}
function back(){
    flag=1;
    $('#nakami').css('display', 'block');
    $('#stamp').css('display', 'block');
    $('#chgImg').css('display', 'block');
    $('#nav_edit').css('display', 'block');   
    $('#save').css('display', 'none'); 
}



//stampについて
var imgObj = document.getElementById('num');

function changeStamp(n){
    imgObj.src="./stamp/stamp"+n+".png";
}
function drawImage(pos) {
    //var src = document.getElementById('num').src;
    //console.log(src);
    var img = new Image();
    //ここにcanvasに入れたい画像
    img.src = imgObj.src;
    cxt.drawImage(img, pos.x, pos.y);
    cPush();
}
