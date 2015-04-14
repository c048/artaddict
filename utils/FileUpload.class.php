<?php

    Class FileUpload {
        
        private $m_sNewName;
        private $m_sExtension;
        private $m_sTmpName;
        
        function __construct($p_sSrcName, $p_sSrcTmpLoc) {
            $this->setTmpName($p_sSrcTmpLoc);
            $this->setFileName($p_sSrcName);
            $this->setExtension($p_sSrcName);
        }
        
        private function setTmpName($p_sSrcTmpLoc) {
            $this->m_sTmpName = $p_sSrcTmpLoc;
        }
        
        private function setFileName($p_sSrcName) {
            $l_sUniqueName = (date("H:i:s")*rand(2,189)*3215) . "_" . (date("H:i:s")*rand(2,189)*3215);
            $this->m_sNewName = (preg_replace('/\\.[^.\\s]{3,4}$/', '', $l_sUniqueName)) . '.jpg';
        }
        
        private function setExtension($p_sSrcName) {
            $this->m_sExtension = strtolower(pathinfo($p_sSrcName, PATHINFO_EXTENSION));
        }
        
        public function image($p_sDir, $p_nWidth = 0, $p_nHeight = 0) {

            switch ($this->m_sExtension) {
                case "jpg":
                    $l_oSrc = imagecreatefromjpeg($this->m_sTmpName);
                    break;
                case "jpeg":
                    $l_oSrc = imagecreatefromjpeg($this->m_sTmpName);
                    break;
                case "gif":
                    $l_oSrc = imagecreatefromgif($this->m_sTmpName);
                    break;
                case "png":
                    $l_oSrc = imagecreatefrompng($this->m_sTmpName);
                    break;
                default:
                    echo "File type unknown";
                    break;
            }

            list($l_nSrcWidth,$l_nSrcHeight) = getimagesize($this->m_sTmpName);

            if($p_nWidth == 0 || $p_nHeight == 0) {
                $p_nWidth = $l_nSrcWidth;
                $p_nHeight = $l_nSrcHeight;
            }

            if ($l_nSrcWidth>$l_nSrcHeight) {
                $p_nHeight = $l_nSrcHeight*($p_nWidth/$l_nSrcWidth);
            } else {
                $p_nWidth = $l_nSrcWidth*($p_nHeight/$l_nSrcHeight);
            }

            $l_oNewImg = imagecreatetruecolor($p_nWidth,$p_nHeight);
            imagecopyresampled($l_oNewImg, $l_oSrc, 0, 0, 0, 0, $p_nWidth, $p_nHeight, $l_nSrcWidth, $l_nSrcHeight);
            $l_sNewFileName = (preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->m_sNewName)) . '.jpg';

            imagejpeg($l_oNewImg, $p_sDir . $l_sNewFileName, 100);

            imagedestroy($l_oSrc);
            imagedestroy($l_oNewImg);

            return($l_sNewFileName);

        }
        
    }