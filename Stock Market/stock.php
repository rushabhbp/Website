
<?php if(isset($_GET['symbol'])):?>
<html >
     <head>
          <title>Stock Details</title>
         <style>
             td {background-color:#F3F3F3;}
             b1 {background-color:#00FF00;}
         </style>
     </head>
    
    <body style="text-align: center; ">
        <script type="text/javascript">
           
                
                function func_clear()
                {
                    if(document.getElementById('tableid'))
                        document.getElementById('tableid').innerHTML="";
                    if(document.getElementById('tableid2'))
                        document.getElementById('tableid2').innerHTML="";
                    
                    document.getElementById("cname2").value="";
                  //  $_GET['cname']='';
                     
                    
                }
                
            </script>
         <div style="border-style: groove;border-color:#F3F3F3;width:560px;text-align: center;margin: auto;margin-top:10px;background-color: #F3F3F3;">     
            
             <h1 style="margin-top:0px;margin-bottom:0px;"><i>Stock Search</i></h1><hr/>
     
             <form method="GET">
  
             <div> Company Name or Symbol: <input type="text" name="cname" id="cname2" value="<?php echo isset($_GET['cname']) ?$_GET['cname'] : "" ?>" maxlength="256" size="20" required  ></div><br>
                 <input type="submit" name="search" value="Search" style="margin-left:160px;border-radius: 5px;margin-bottom:0px;background-color: white;">
     
                <input type="button" name="clear" value="Clear" onclick="func_clear()" style="margin-left:10px;border-radius: 5px;background-color: white;margin-bottom:10px;"><br>
     
            <a href="http://www.markit.com/product/markit-on-demand" style="padding-bottom:100px;padding-left:130px; padding-top:10px; margin-top:10px;">Powered by Markit on Demand</a>  
 
            
        </div> 
    <?php 
    
            $te='http://dev.markitondemand.com/MODApis/Api/v2/Quote/json?symbol='.$_GET['symbol'];
            $json=file_get_contents($te);                       
            $jsondata=json_decode($json);
            if($jsondata->Status!="SUCCESS") :  ?>
             <div id="tableid1">             
             <table id="tableid" style=" border-style:solid;width:400px; text-align: center;margin: auto; margin-top:10px ">
        
                 <tr><td>There is no stock information available</td></tr>
        
             </table>
    <?php else:?> 
             
        
            
        <table id="tableid2" border="1" style="border-style:solid;width:500px;margin:auto; margin-top:10px; border-collapse:collapse;">
        
            <tr>
                <td>Name</td>
                <td style="background-color:#FAFAFA; text-align:center;" ><?php echo $jsondata->Name?></td>
            </tr>
            
            <tr>
            <td>Symbol</td>
            <td style="background-color:#FAFAFA; text-align:center;"><?php echo $jsondata->Symbol?></td>
            </tr>
            
             <tr>
             <td>Last Price</td>
             <td style="background-color:#FAFAFA; text-align:center;"><?php echo $jsondata->LastPrice?></td>
             </tr>
            
            <tr>
               <td>Change</td>
            <?php if($jsondata->Change<0):?>
                
                <td style="background-color:#FAFAFA; text-align:center;"><?php echo round($jsondata->Change,2); ?>% <img src="Red_Arrow_Down.png" width='10px' height='10px'></td>
            <?php else :?>
            <td style="background-color:#FAFAFA; text-align:center;"><?php echo round($jsondata->Change,2); ?>% <img src="Green_Arrow_Up.png" width='10px' height='10px'></td>
                <?php endif;?>
            </tr>
            
            <tr>
            <td>Change Percent</td>
            <?php if($jsondata->ChangePercent<0):?>
                
                <td style="background-color:#FAFAFA; text-align:center;"><?php echo round($jsondata->ChangePercent,2); ?>% <img src="Red_Arrow_Down.png" width='10px' height='10px'></td>
            <?php else :?>
            <td style="background-color:#FAFAFA; text-align:center;"><?php echo round($jsondata->ChangePercent,2); ?>% <img src="Green_Arrow_Up.png" width='10px' height='10px'></td>
                <?php endif;?>
            </tr>
            
            <tr>
            <td>Timestamp</td>
            <td style="background-color:#FAFAFA; text-align:center;"><?php
                date_default_timezone_set('America/Los_Angeles');
                $z=strtotime($jsondata->Timestamp);
                //$date = new DateTime($z);
                $d= date("Y-m-d g:i A",strtotime($jsondata->Timestamp));
                echo $d;?></td>
            </tr>
            
            <tr>
            <td>Market Cap</td>
            <td style="background-color:#FAFAFA; text-align:center;"><?php 
               // $jMarketCap=$jsondata->MarketCap/1000000000;
                if(round($jsondata->MarketCap/1000000000,2)==0):
                echo round($jsondata->MarketCap/1000000,2);?> M</td>
               <?php else:
                echo round($jsondata->MarketCap/1000000000,2);?>
                B</td>
                 <?php endif;?>
            </tr>
            
            <tr>
            <td>Volume</td>
            <td style="background-color:#FAFAFA; text-align:center;"><?php echo number_format($jsondata->Volume)?></td>
            </tr>
            
            <tr>
            <td>Change YTD</td>
            <?php if($jsondata->LastPrice-$jsondata->ChangeYTD<0):?>
                
                <td style="background-color:#FAFAFA; text-align:center;">(<?php echo round(($jsondata->LastPrice-$jsondata->ChangeYTD),2); ?>) <img src="Red_Arrow_Down.png" width='10px' height='10px'></td>
            <?php else :?>
            <td style="background-color:#FAFAFA; text-align:center;"><?php echo round(($jsondata->LastPrice-$jsondata->ChangeYTD),2); ?> <img src="Green_Arrow_Up.png" width='10px' height='10px'></td>
                 <?php endif;?>
            </tr>
            
            
            <tr>
            <td>Change Percent YTD</td>
            <?php if(($jsondata->ChangePercentYTD)<0):?>
                
                <td style="background-color:#FAFAFA; text-align:center;"><?php echo round($jsondata->ChangePercentYTD,2); ?>% <img src="Red_Arrow_Down.png" width='10px' height='10px'></td>
            <?php else :?>
                <td style="background-color:#FAFAFA; text-align:center;"><?php echo round($jsondata->ChangePercentYTD,2); ?>% <img src="Green_Arrow_Up.png" width='10px' height='10px'></td>
              <?php endif;?>  
            </tr>
            
            <tr>
            <td>High</td>
            <td style="background-color:#FAFAFA; text-align:center;"><?php echo $jsondata->High?></td>
            </tr>
            
            <tr>
            <td>Low</td>
            <td style="background-color:#FAFAFA; text-align:center;"><?php echo $jsondata->Low?></td>
            </tr>
            
            <tr>
            <td>Open</td>
            <td style="background-color:#FAFAFA; text-align:center;"><?php echo $jsondata->Open?></td>
            </tr>
  
            </table>
            
 <?php endif;?>
            </div>
        </form>
    </body>    
</html>  



<?php elseif(isset($_GET["search"])) :?>

<html >
    <head>
      <title>Stock Details</title>
        <style>
            td{background-color: #FAFAFA;}
        </style>
    </head>
    
    <body style="text-align: center; margin: auto;">
         <script type="text/javascript">
           
                document.getElementById("cname2").value=cname;
                function func_clear()
                {   
                    if(document.getElementById('tableid2'))
                        document.getElementById('tableid2').innerHTML="";
                    if( document.getElementById('tableid3'))
                        document.getElementById('tableid3').innerHTML="";
                    document.getElementById("cname2").value="";
                    
                    
                }
                
            </script>
     
        <div style="border-style: groove;border-color:#F3F3F3;width:560px;text-align: center;margin: auto;margin-top:10px;background-color: #F3F3F3;">     
         
            <h1 style="margin-top:0px;margin-bottom:0px;"><i>Stock Search</i></h1><hr/>
         
 
            <form method="GET">
 
              <div>  Company Name or Symbol: <input type="text" name="cname" id="cname2" value="<?php echo isset($_GET['cname']) ?$_GET['cname'] : "" ?>" maxlength="256" size="20" required ></div><br>
                         
                <input type="submit" name="search" value="Search" style="margin-left:160px;border-radius: 5px;margin-bottom:0px;background-color: white;">
                
     
                <input type="button" name="clear" value="Clear" onclick="func_clear()" style="margin-left:10px;border-radius: 5px;background-color: white;margin-bottom:10px;"><br>
     
            <a href="http://www.markit.com/product/markit-on-demand" style="padding-bottom:100px;padding-left:130px; padding-top:10px; margin-top:10px;">Powered by Markit on Demand</a>
                
            <?php 
    
                $objectarr=simplexml_load_file("http://dev.markitondemand.com/MODApis/Api/v2/Lookup/xml?input=$_GET[cname]");
                                                    
                     /* if(@simplexml_load_file("http://dev.markitondemand.com/MODApis/Api/v2/Lookup/xml?input=$_GET[cname]")):
                          
                      
                          echo "error";
                      
                else:
                
                    $objectarr=simplexml_load_file("http://dev.markitondemand.com/MODApis/Api/v2/Lookup/xml?input=$_GET[cname]");
                endif;*/
                                              $json=file_get_contents('http://dev.markitondemand.com/MODApis/Api/v2/Quote/json?symbol=aapl');                       
        
                                              $jsondata=json_decode($json);
       
              ?>
 
        </div> 
        
      
            <?php  if($objectarr->count()==0):?>
            <table id="tableid3" style=" border-style:solid;width:400px; text-align: center;margin: auto; margin-top:10px ">
            <tr><td><?php echo "No Records has been found";?></td></tr></table>
            
            <div id="tableid2"  >
        <?php else :?>
        <table id="tableid2" border=".5" style="width:700px;margin:auto;border-collapse:collapse; margin-top:10px " >
            <tr style="background-color: #F3F3F3;">
                <th>Name</th>
                <th>Symbol</th>
                <th>Exchange</th>
                <th>Details</th>
            </tr> 
 <?php 
    for($i=0;$i<$objectarr->count();$i++)
       {
            echo '<tr>';
            echo  " <td> ".$objectarr->LookupResult[$i]->Name."</td>";
            echo  "<td>".$objectarr->LookupResult[$i]->Symbol."</td>";
            echo  "<td>".$objectarr->LookupResult[$i]->Exchange."</td>";
            $temp="http://dev.markitondemand.com/MODApis/Api/v2/Quote/json?symbol=".$objectarr->LookupResult[$i]->Symbol;
           // echo  '<td><a href="stock.php?symbol='.$objectarr->LookupResult[$i]->Symbol.'">More Info</a>';
                echo  '<td><a name="lin" href="'.$_SERVER['PHP_SELF'].'?symbol='.$objectarr->LookupResult[$i]->Symbol.'&cname='.$_GET['cname'].'">More Info</a>';
            echo '</tr>';
      }?>
         </table>
         
            
        </div>        
 </form>
    </body>    
</html>
<?php endif ;?>
<?php else: ?>

<html >
     <head>
          <title>Stock Details</title>
      </head>
 
    <body style="text-align: center;width:960px margin: auto;">
     
        <div  style="border-style:groove;border-color:#F3F3F3; width:560px;text-align: center;margin:auto;margin-top:10px;background-color: #F3F3F3;">     
        
            <h1 style="margin-top:0px;margin-bottom:0px;"><i>Stock Search</i></h1><hr />
            <script type="text/javascript">
            
                
                function func_clear()
                {
                    document.getElementById("cname").innerHTML="";
                    document.getElementById("tableid").innerHTML="";
                }
                
            </script>
 
            <form method="get">
  
                <div>Company Name or Symbol: <input type="text" name="cname" id="cname" maxlength="256" size="20" required ></div><br/>
                
                       
                <input type="submit" name="search" value="Search"  style="margin-left:160px;border-radius: 5px;margin-bottom:0px;background-color: white;">
     
                <input type="button" name="clear" value="Clear"  onclick="func_clear()" style="margin-left:10px;border-radius: 5px;background-color: white;margin-bottom:10px;"><br>
                
     
            <a href="http://www.markit.com/product/markit-on-demand" style="padding-bottom:100px;padding-left:130px;padding-top:10px; margin-top:10px;">Powered by Markit on Demand</a>
    
            </form>
        </div> 
 
     </body>
 
</html>
<?php endif; ?>