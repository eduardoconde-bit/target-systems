<?php

    //Enumerator for file type
    enum DataFileType: string {
        case xml = 'application/xml';
        case json = 'application/json';
        case csv = 'text/csv';
        //etc...
    }

    class FileLoader {

        public string $path;
        public string $type;

        public function __construct(string $path)
        {
            $this->path = $path;
            //$this->type = $type;
        }

        //Detect Mime Type
        public function detectFileType():?DataFileType
        {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $this->path);
            finfo_close($finfo);

            if ($mimeType === 'text/plain' && pathinfo($this->path, PATHINFO_EXTENSION))
            {
                echo $this->path;
                return DataFileType::csv;
            }

            return match($mimeType) 
            {
                DataFileType::json->value => DataFileType::json,
                DataFileType::xml->value => DataFileType::xml,
                DataFileType::csv->value => DataFileType::csv,
                default => null,
            };
        }

        public function runFileLoader():array|bool 
        {
            //Switch Function json, csv  and others...
            $mimeType = $this->detectFileType();
            if(!empty($mimeType)) {
                return match ($mimeType) {
                    DataFileType::json => $this->fileLoaderJSON(),
                    DataFileType::xml => $this->fileLoaderXML(),
                    DataFileType::csv => $this->fileLoaderCSV(),
                };
            }
            return false;
        }
    
        public function fileLoaderJSON():array|bool
        {
            try { 
                return $this->invoicingData = json_decode(file_get_contents($this->path));
            } catch(Exception $e) {
                //Logfile = $e;
                return false;
            }
        }
    
        public function fileLoaderXML() {
            //Implementation
        }

        public function fileLoaderCSV() {
            echo "CSV!";
            //Implementation
        }
    }

    class Invoicing {

        public int $DAAverageRevenue; //Days Above Average Revenue
        public float $average;
        public float $maxInv;
        public float $minInv;
        public $invoicingData;
        public FileLoader $fileLoader;

        function __construct(FileLoader $fileLoader) {
            $this->DAAverageRevenue = 0;
            $this->average = 0;
            $this->maxInv = 0;
            $this->minInv = 0;
            $this->fileLoader = $fileLoader;
            //$this->invoicingProcess();
        }

        //Process Average, Max Value and Min Value
        public function invoicingProcess():bool
        {

            $invoicingValid = 0; //Count

            $this->invoicingData = $this->fileLoader->runFileLoader();

            if($this->invoicingData) {
                try {
                    foreach($this->invoicingData as $invoicing) {

                        if($invoicing->valor > 0) {
                            $invoicingValid++;
                            //Progressive Average
                            $this->average = (($this->average * ($invoicingValid - 1)) + $invoicing->valor) / $invoicingValid;
                            //Max Value and Min Value;
                            if ($invoicing->valor > $this->maxInv) {
                                $this->maxInv = $invoicing->valor;
                            }
                            //Takes the first valid billing as the minimum
                            if($invoicingValid === 1) {
                                $this->minInv = $invoicing->valor;
                            } elseif($invoicing->valor < $this->minInv) {
                                $this->minInv = $invoicing->valor;
                            }
                        }
                    }
                    
                    foreach($this->invoicingData as $invoicing) {
                        if ($invoicing->valor > $this->average) {
                            $this->DAAverageRevenue++;
                        }
                    }

                    return true;
    
                } catch (Exception $e) {
                    //Logfile = $e;
                    return false;
                }
            }
            return false;
        }
    }
?>