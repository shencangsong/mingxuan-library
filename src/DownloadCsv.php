<?php
namespace Mingxuan;

class DownloadCsv{
	/**
	 * 操作对象
	 * @var [type]
	 */
	private $fp;

	/**
	 * 构造函数
	 * @param string $filename [description]
	 */
	public function __construct($filename='download'){
		set_time_limit(0);
		ini_set('memory_limit', '900M');
		error_reporting(0);

		$this->fp = fopen('php://output', 'a');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'.csv"');		 
	}

	/**
	 * 设置表头
	 */
	public function setHeaders($headers = []){
	    if($headers){
            foreach ($headers as $k => $v) {
                $headers[$k] = iconv('utf-8', 'gb2312', $v);
            }
            fputcsv($this->fp, $headers);
        }
	}

	/**
	 * 添加多行数据
	 * @param array $list [description] 二维数组
	 */
	public function addMutliColData($list=[]){
		foreach ($list as $k => $row) {
	        foreach ($row as $second_key => $item) {
	            $row[$second_key] = iconv('utf-8', 'gb2312', $item) . "\t";
	        }
	        fputcsv($this->fp, $row);
	        ob_flush();
	        flush();
	    }
	}
}