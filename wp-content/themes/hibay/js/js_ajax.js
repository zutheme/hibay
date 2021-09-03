var start = 0;
var _width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
var _height = (window.innerHeight > 0) ? window.innerHeight : screen.height;
var _e_quiz_test = document.getElementsByClassName("quiz-test-show")[0];
var _e_btn_start = _e_quiz_test.getElementsByClassName("btn-start")[0];
var _e_btn_next = _e_quiz_test.getElementsByClassName("btn-next")[0];
var _e_btn_prev = _e_quiz_test.getElementsByClassName("btn-prev")[0];
var e_popup_processing = document.getElementsByClassName('htz-popup-processing')[0];
var _e_desc_begin = _e_quiz_test.getElementsByClassName("desc-begin")[0];
_e_btn_start.addEventListener("click",nextquest);
_e_btn_next.addEventListener("click",nextquest);
_e_btn_prev.addEventListener("click",prevquest);
var _idpost = 0,order = 1;
var str_answ = [];
var e_form_quiz = document.getElementById('form-quiz');
var _e_close = e_form_quiz.getElementsByClassName('close')[0];
_e_close.addEventListener('click',function(){
    e_form_quiz.style.display = "none";
    var _e_body = document.getElementsByTagName('body')[0];
    _e_body.style.display = "block";
});
var e_note = _e_quiz_test.getElementsByClassName("note")[0];
function prevquest(){
    var _idpostback = 0;
    start = start - 1;
    if(start > 0) {
        for (var i = 0; i < str_answ.length; i++) {
            if(str_answ[i].numquest == start){
                var _idpost = str_answ[i].idpost;
                //console.log(str_answ[i].numquest);
                makeAJAXCall(_idpost,renderdata);
            }
        }
        
        // let ans = [];
        //  var elstchk = _e_quiz_test.getElementsByClassName("list-question")[0].getElementsByClassName('list-check');
        //  var _content_answer = '';
        //  var hd_id_post = 0, char_ans='';
        //  var _title = _e_quiz_test.getElementsByClassName("question-title")[0].innerText;
        //  for (var i = 0; i < elstchk.length; i++) {
        //     if(elstchk[i].checked == true){
        //         char_ans = elstchk[i].parentElement.getElementsByClassName('question')[0].innerText;
        //         _content_answer = elstchk[i].parentElement.getElementsByClassName('content-answer')[0].innerText;
        //         let _arr_char_ans = {"user_ans":char_ans , "quiz_content":_content_answer}
        //         ans.push(_arr_char_ans);
        //         hd_id_post = elstchk[i].parentElement.getElementsByClassName('hidden_idpost')[0].value;
        //     }
        //  }
        //  var _exit = existnumquest(start, ans);
        //  if(!_exit){
        //     let obj = {"numquest":start, "title":_title ,"idpost":hd_id_post,"ans":ans};
        //     str_answ.push(obj);
        //  }
        
    }else {
        start = 1;
        _e_btn_prev.style.display = 'none';
    }
}
function nextquest(){
	if(start==0){
		_e_desc_begin.style.display = 'none';
        _e_btn_start.style.display = 'none';
       
	}else{
     let ans = [];
	 var elstchk = _e_quiz_test.getElementsByClassName("list-question")[0].getElementsByClassName('list-check');
     var _content_answer = '';
	 var hd_id_post = 0, char_ans='';
     var _title = _e_quiz_test.getElementsByClassName("question-title")[0].innerText;
		 for (var i = 0; i < elstchk.length; i++) {
		 	if(elstchk[i].checked == true){
                char_ans = elstchk[i].parentElement.getElementsByClassName('question')[0].innerText;
                _content_answer = elstchk[i].parentElement.getElementsByClassName('content-answer')[0].innerText;
                let _arr_char_ans = {"user_ans":char_ans , "quiz_content":_content_answer}
                ans.push(_arr_char_ans);
                hd_id_post = elstchk[i].parentElement.getElementsByClassName('hidden_idpost')[0].value;
		 	}
		 }
         var _exit = existnumquest(start, ans);
         if(!_exit){
            let obj = {"numquest":start, "title":_title ,"idpost":hd_id_post,"ans":ans};
            str_answ.push(obj);
         }
         //console.log(str_answ);
	}
    if(start >= 0 && start < list_question.length){
        _idpost = list_question[start];
        makeAJAXCall(_idpost,renderdata);
        //list_question.shift();
        start++;
    }else if(start == list_question.length){
        //var data = JSON.stringify(str_answ);
        var e_desc = _e_quiz_test.getElementsByClassName('desc-begin')[0];
        var _idpost = e_desc.getElementsByClassName("idtopic")[0].value;
        //MakeOutResult(_idpost,data,RenderResult);   
        var e_ul = _e_quiz_test.getElementsByClassName('list-question')[0];
        while (e_ul.firstChild) {
            e_ul.removeChild(e_ul.firstChild);
        }
        //console.log(summary);
        _e_quiz_test.style.paddingTop = '20%';
        _e_quiz_test.getElementsByClassName('question-title')[0].innerHTML = 'Cảm ơn anh/chị đã tham gia khảo sát';
        _e_quiz_test.getElementsByClassName('question-content')[0].innerHTML = 'Hệ thống đã tiếp nhận thông tin và phản hồi trong thời gian sớm nhất có thể';
        e_form_quiz.style.display = "block"; 
        _e_btn_next.style.display = "none";
        _e_btn_prev.style.display = 'none';
        e_note.style.display = "none";
    	return false;
    }
}
function showanswered(_start){
    var _e_question =  _e_quiz_test.getElementsByClassName("question");
    for (var i = 0; i < str_answ.length; i++) {
        if(str_answ[i].numquest == _start){
          let _ans = str_answ[i].ans;
           if(_ans.length > 0){
              for (var j = 0; j < _ans.length; j++) {
                for (var t = 0; t < _e_question.length; t++) {
                  if(_e_question[t].innerHTML === _ans[j].user_ans){
                      choose(_e_question[t]);
                  }
                }
              }
           }
        }
     }
}
function existnumquest(start, _ans){
     for (var i = 0; i < str_answ.length; i++) {
        if(str_answ[i].numquest == start){
           str_answ[i].ans = _ans;
           return true;
        }
     }
     return false;
}
function makeAJAXCall(_idpost,callback){
    var http = new XMLHttpRequest();
    var url = MyAjax.ajaxurl+"?action=request_question";
    var params = JSON.stringify({"idpost":_idpost});
    http.open("POST", url, true);
    http.setRequestHeader("Accept", "application/json");
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    e_popup_processing.style.display = "block";
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
        	callback(this.responseText);     
        }
    }
    http.send(params);
    //console.log("request sent to the server");
 }

function renderdata(data){
 	if(data){
 		var myArr = JSON.parse(data);
        var hdidpost = 0;
        console.log(myArr);
        Object.keys(myArr).forEach(function(key) {
          if(key==='idpost'){
                hdidpost = myArr[key];
          }
          if(key==='title'){
          		_e_quiz_test.getElementsByClassName('question-title')[0].innerHTML = myArr[key];
          }
          if(key==='content'){
                _e_quiz_test.getElementsByClassName('question-content')[0].innerHTML = myArr[key];
          }
          if(key==='list-quest'){
                var e_ul = _e_quiz_test.getElementsByClassName('list-question')[0];
                while (e_ul.firstChild) {
                    e_ul.removeChild(e_ul.firstChild);
                }
                var li_len = myArr[key].length;
                var _with_li = 0;
                _with_li = '100%';
                // if(_width < 768){
                // 	_with_li = '50%';
                // }else{
                //     if (li_len == 1) {
                // 	   _with_li = '100%';
                //     }else if(li_len == 2){
                //         _with_li = '50%';
                //     }else if (li_len == 3){
                //         _with_li = '33.33%';
                //     }else {
                //         _with_li = '25%';
                //     }
                // }
                var e_li,e_span,e_p,e_chkbx;
                var lst_char = ['A','B','C','D','E','F','G','H','I','K'];
                for (var i = 0; i < li_len; i++) {
                    eli = document.createElement("li");
                    eli.style.cssText = "width:"+_with_li;
                    e_div = document.createElement("div");
                    e_div.setAttribute("class", "area-question");
                    e_span = document.createElement("span");
                    e_span.setAttribute("class", "question");
                    e_span.setAttribute("onclick", "choose(this)");
                    e_span.innerHTML = lst_char[i];
                    e_chkbx = document.createElement("input");
                    e_chkbx.setAttribute("type", "checkbox");
                    e_chkbx.setAttribute("class", "list-check");
                    e_chkbx.setAttribute("name", "lstchk[]");
                    e_hdidpost = document.createElement("input");
                    e_hdidpost.setAttribute("type", "hidden");
                    e_hdidpost.setAttribute("class", "hidden_idpost");
                    e_hdidpost.setAttribute("name", "name_idpost");
                    e_hdidpost.value = hdidpost;
                    e_div_content = document.createElement("div");
                    e_div_content.setAttribute("class", "content");
                    e_p = document.createElement("p");
                    e_p.setAttribute("class", "content-answer");
                    e_p.innerHTML = myArr[key][i];
                    e_div.appendChild(e_span);
                    e_div.appendChild(e_chkbx);
                    e_div_content.appendChild(e_p);
                    e_div.appendChild(e_div_content);
                    e_div.appendChild(e_hdidpost);
                    //e_div.appendChild(e_div);
                    eli.appendChild(e_div);
                    e_ul.appendChild(eli);
                }
          }
        });
        order++;
        showanswered(start); 
         e_note.style.display = "block";
        _e_btn_next.style.display = 'block';
        _e_btn_prev.style.display = 'block';
        e_popup_processing.style.display = "none";
    }

 }
 function choose(element){
	 var eparent = element.parentElement.parentElement;
	 var echk = eparent.getElementsByClassName('list-check')[0];
	 if(echk.checked == true){
	 	echk.checked = false;
	 	echk.setAttribute('checked', '');
        element.style.background = "none";
	 }else {
	 	echk.checked = true;
	 	echk.setAttribute('checked', 'checked');
        element.style.background = "#F8AE90";
	 }
	 plusclass(eparent,'checked');
}

function plusclass(element,name) {
  var arr;
  arr = element.className.split(" ");
  if (arr.indexOf(name) == -1) {
    element.className += " " + name;
  }else{
  	//var rpclass = "/"+name+"/g";
  	element.className = element.className.replace(/\bchecked\b/g, "");
  }
}
//console.log(_term_id);
function MakeOutResult( _idpost, _strjson, callback){
    var http = new XMLHttpRequest();
    var url = MyAjax.ajaxurl+"?action=outresult";
    var params = JSON.stringify({"idpost":_idpost,"data":_strjson});
    http.open("POST", url, true);
    http.setRequestHeader("Accept", "application/json");
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    e_popup_processing.style.display = "block";
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            callback(this.responseText);
             e_popup_processing.style.display = "none";     
        }
    }
    http.send(params);
 }

function RenderResult(data){
    if(data){
       var myArr = JSON.parse(data);
        _e_quiz_test.getElementsByClassName('question-title')[0].innerHTML = 'Cảm ơn bạn đã tham gia khảo sát';
        _e_quiz_test.getElementsByClassName('question-content')[0].innerHTML = 'Hệ thống đã tiếp nhận thông tin và phản hồi trong thời gian sớm nhất có thể';
        e_form_quiz.style.display = "block"; 
        //Object.keys(myArr).forEach(function(key) {
        //e_popup_processing.style.display = "none";
    //});
    }
}
