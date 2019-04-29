jQuery(function() {
    var $ = jQuery,
        $list = $('#thelist'),
        $btn = $('#ctlBtn'),
        state = 'pending',
        uploader;

    uploader = WebUploader.create({
        resize: false,
        swf: '/Public/Admin/webup/Uploader.swf',
        chunked:true,
        chunkSize:2*1024*1024,
        threads:1,
        auto: true,
        // formDate:{guid:GUID},
        server: '/upload.php',
        pick: '#picker'
    });

        // 文件上传成功,合并文件。
        uploader.on('uploadSuccess', function (file, response) {
            if (response.chunked) {
                $.post("MergeFiles.ashx", { guid: GUID, fileExt: response.f_ext },
                function (data) {
                    data = $.parseJSON(data);
                    if (data.hasError) {
                        alert('文件合并失败！');
                    } else {
                        alert(decodeURIComponent(data.savePath));
                    }
                });
            }
        });

    uploader.on( 'fileQueued', function( file ) {
        $list.append( '<div id="' + file.id + '" class="item" style="height:44px;">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p class="state">等待上传...</p>' +
        '</div>' );
    });

    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress .progress-bar');
        if ( !$percent.length ) {
            $percent = $('<div class="progress progress-striped active">' +
              '<div class="progress-bar" role="progressbar" style="width: 0%">' +
              '</div>' +
            '</div>').appendTo( $li ).find('.progress-bar');
        }

        $li.find('p.state').text('上传中');

        $percent.css( 'width', percentage * 100 + '%' );
    });

    uploader.on( 'uploadSuccess', function( file,response ) {
        $( '#'+file.id ).find('p.state').text('已上传');
        var file_url=response.filePaht;
        var regS = new RegExp("\\\\","g");
        if(file_url){
		  file_url=file_url.replace(regS,"/");
        }
        var oldName=response.oldName;
        $('#file_url').val(file_url);
        $('#oldName').val(oldName);
    });

    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传出错');
    });

    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').fadeOut();
    });

});