<?php

return [

    'cdn' => function() {
        return asset('vendor/js/tinymce/tinymce.min.js');
    },
    /* 'baseUrl' => function(){
      return asset('/vendor/js/tinymce');
      }, */
    'params' => [
        "selector" => "#mytiny",
        "height"=> "600",
        "language" => 'pt_BR',
        "theme" => "modern",
        "skin" => "lightgray",
        "plugins" => [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        "toolbar" => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
    ]
];
