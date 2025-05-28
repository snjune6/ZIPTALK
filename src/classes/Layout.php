<?php

namespace src\classes;

class Layout {
    protected $header;
    protected $footer;
    protected $siteData;




    // 헤더 설정
    public function setHeader($header) {
        $this->header = $header;
    }

    // 푸터 설정
    public function setFooter($footer) {
        $this->footer = $footer;
    }

    // 사이트 데이터
    public function setSiteData($siteData) {
        $this->siteData = $siteData;
    }



    // 레이아웃 렌더링
    public function render($contentFile = null) {
        $header = $this->header;
        $footer = $this->footer;
        $siteData = $this->siteData;

        if (file_exists($contentFile)) {
            include $header;
            include $contentFile;
            include $footer;
        } else {
            echo "컨텐츠 파일이 없습니다.";
        }
    }
}
