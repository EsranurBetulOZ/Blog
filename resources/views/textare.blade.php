<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="editor"> Metninizi buraya girin.. </div>
    <div class = "btn-toolbar" data-role = "editor-toolbar" data-target = "#editor">
        <div class = "btn-group">
        <a class = "btn dropdown-toggle" data-toggle = "dropdown" title = "Yazı Tipi">
        <i class="icon-font"></i><b class="caret"></b></a>
        <ul class = "açılır menü">
        </ul>
        </div>
        <div class = "btn-group">
        <a class = "btn dropdown-toggle" data-toggle = "dropdown" title = "Yazı Tipi Boyutu">
        <i class="icon-text-height"></i> <b class="caret"></b></a>
        <ul class = "açılır menü">
        <li><a data-edit="fontSize 5"><font size="5">Çok büyük</font></a></li>
        <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
        <li><a data-edit="fontSize 1"><font size="1">Küçük</font></a></li>
        </ul>
        </div>
        <div class = "btn-group">
        <a class = "btn" data-edit = "kalın" title = "Kalın (Ctrl/Cmd+B)">
        <i class="icon-bold"></i></a>
        <a class = "btn" data-edit = "italic" title = "İtalik (Ctrl/Cmd+I)">
        <i class="icon-italic"></i></a>
        <a class = "btn" data-edit = "üstü çizili" title = "üstü çizili">
        <i class="icon-strikethrough"></i></a>
        <a class = "btn" data-edit = "altı çizili" title = "Altı çizili (Ctrl/Cmd+U)">
        <i class="icon-underline"></i></a>
        </div>
        <div class = "btn-group">
        <a class = "btn" data-edit = "insertunorderedlist" title = "Madde işaretli liste">
        <i class="icon-list-ul"></i></a>
        <a class = "btn" data-edit = "insertorderedlist" title = "Numara listesi">
        <i class="icon-list-ol"></i></a>
        <a class = "btn" data-edit = "outdent" title = "Girintiyi azalt (Shift+Sekme)">
        <i class="icon-indent-left"></i></a>
        <a class = "btn" data-edit = "indent" title = "Girinti (Sekme)">
        <i class="icon-indent-right"></i></a>
        </div>
        <div class = "btn-group">
        <a class = "btn" data-edit = "justifyleft" title = "Sola Hizala (Ctrl/Cmd+L)">
        <i class="icon-align-left"></i></a>
        <a class = "btn" data-edit = "justifycenter" title = "Merkez (Ctrl/Cmd+E)">
        <i class="icon-align-center"></i></a>
        <a class = "btn" data-edit = "justifyright" title = "Sağa Hizala (Ctrl/Cmd+R)">
        <i class="icon-align-right"></i></a>
        <a class = "btn" data-edit = "justifyfull" title = İki yana yasla (Ctrl/Cmd+J)">
        <i class="icon-align-justify"></i></a>
        </div>
        <div class = "btn-group">
        <a class = "btn dropdown-toggle" data-toggle = "dropdown" title = "Köprü">
        <i class="icon-link"></i></a>
        <div class="açılır-menü girişi-ekleme">
        <input class = "span2" placeholder = "URL" type = "metin" data-edit = "createLink"/>
        <button class="btn" type="button">Ekle</button>
        </div>
        <a class = "btn" data-edit = "unlink" title = "Köprü Bağlantısını Kaldır">
        <i class="icon-cut"></i></a>
        
        </div>
        
        <div class = "btn-group">
        <a class = "btn" title = "Resim ekle (veya yalnızca sürükleyip bırak)" id = "pictureBtn">
        <i class="icon-picture"></i></a>
        <input type = "dosya" data-role = "magic-overlay" data-target = "#pictureBtn"
        data-edit = "insertImage" />
        </div>
        <div class = "btn-group">
        <a class = "btn" data-edit = "geri al" title = "Geri al (Ctrl/Cmd+Z)">
        <i class="icon-geri al"></i></a>
        <a class = "btn" data-edit = "yeniden yap" title = "Yeniden yap (Ctrl/Cmd+Y)">
        <i class="icon-repeat"></i></a>
        </div>
        <input type = "metin" data-edit = "inserttext" id = "voiceBtn" x-webkit-speech = "">
        </div>



        $(function(){
            function initToolbarBootstrapBindings() {
            var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 
            'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
            $.each(fonts, function (idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" 
            style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
            });
            $('a[title]').tooltip({container:'body'});
            $('.dropdown-menu input').click(function() {return false;})
            .change(function () {$(this).parent('.dropdown-menu').
            siblings('.dropdown-toggle').dropdown('toggle');})
            .keydown('esc', function () {this.value='';$(this).change();});
            
            $('[data-role=magic-overlay]').each(function () { 
            var overlay = $(this), target = $(overlay.data('target')); 
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset())
            .width(target.outerWidth()).height(target.outerHeight());
            });
            if ("onwebkitspeechchange" in document.createElement("input")) {
            var editorOffset = $('#editor').offset();
            $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, 
            left: editorOffset.left+$('#editor').innerWidth()-35});
            } else {
            $('#voiceBtn').hide();
            }
            };
            function showErrorAlert (reason, detail) {
            var msg='';
            if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
            else {
            console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"><button type="button" class="close" data-dismiss="alert">
            &times;</button>'+ 
            '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
            };
            initToolbarBootstrapBindings(); 
            $('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
            window.prettyPrint && prettyPrint();
            });
            </script>

        <script type = "text/javascript" src = "js/jquery.js"></script>
        <script type = "text/ascript" src = "js/bootstrap.js"></script>
        <script type = "text/javascript" src = "js/bootstrap-wysiwyg.js"></script>
        <script src="external/jquery.hotkeys.js"></script>
        <script src="external/google-code-prettify/prettify.js"></script>
        <script src=&quo<script src="js/bootstrap-wysiwyg.js"></script>
</body>
</html>