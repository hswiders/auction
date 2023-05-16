<?php 
use App\Models\Common_model;
$this->common_model = new Common_model;
$this->db      = \Config\Database::connect();
 ?>
<table style="border-collapse: collapse; margin: 0px auto; min-width: 100%; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0" align="center" bgcolor="#Efefef">
   <tbody>
      <tr>
         <td style="text-align: center; text-size-adjust: 100%; border-collapse: collapse;" align="center" valign="top" bgcolor="#efefef">
            <table style="border-collapse: collapse; margin: 0px auto; table-layout: fixed;" border="0" width="640" cellspacing="0" cellpadding="0" align="center">
               <tbody>
                  <tr>
                     <td style="border-collapse: collapse; padding: 0px; text-size-adjust: 100%;" align="center" valign="top" width="640">
                        <table style="border-collapse: collapse; table-layout: fixed;" border="0" width="640" cellspacing="0" cellpadding="0" align="center">
                           <tbody>
                              
                              
                              
                              <tr>
                                 <td bgcolor="#00000" width="640" style="text-size-adjust: 100%; border-collapse: collapse;">
                                    <table style="border-collapse: collapse; table-layout: fixed;" border="0" width="640" cellspacing="0" cellpadding="0" align="center">
                                       <tbody>
                                          
                                          <tr>
                                             <td align="center" valign="top" bgcolor="#545977" width="640" style="text-size-adjust: 100%; border-collapse: collapse;">
                                                <table style="border-collapse: collapse; margin: 0px; table-layout: fixed;" border="0" width="640" cellspacing="0" cellpadding="0">
                                                   <tbody>
                                                      
                                                      <tr>
                                                         <td style="border-collapse: collapse;padding: 15px 0px 15px 30px;text-size-adjust: 100%;" align="left"><a href="<?= base_url() ?>" style="text-size-adjust: 100%;text-decoration: none;color: rgb(255, 96, 96);"><img style="display: block;border: none;font-family: ProximaNova, Helvetica, Arial, sans-serif;color: rgb(255, 255, 255);text-transform: none;font-size: 15px;letter-spacing: 1px;line-height: 25px;width: 150px;outline: none;" src="<?= base_url() ?>/assets/img/logo.png" alt="<?= Project ?>" width="120" height="auto"></a></td>
                                                      </tr>
                                                      
                                                      <tr>
                                                         <td style="font-family: ProximaNova, Helvetica, Arial, sans-serif; font-size: 30px; color: rgb(255, 255, 255); text-decoration: none; text-align: center; line-height: 36px; font-weight: 600; text-size-adjust: 100%; border-collapse: collapse;" align="center" width="640"><a href="#" style="color: rgb(255, 255, 255); text-decoration: none; text-size-adjust: 100%;"> <?= $subject ?></a>
                                                         </td>
                                                      </tr>
                                                      
                                                      
                                                      <tr>
                                                         <td style="border-collapse: collapse; padding: 0px; text-size-adjust: 100%;" align="center"><a href="#" style="text-size-adjust: 100%; text-decoration: none; color: rgb(255, 96, 96);"><img style="display: block; border: none; font-family: ProximaNova, Helvetica, Arial, sans-serif; text-transform: none; font-size: 15px; letter-spacing: 1px; line-height: 25px; max-height: 125px; max-width: 640px; text-align: left; outline: none;" src="<?= base_url() ?>/assets/img/emailheader.jpg" alt="" width="640" height="125"></a></td>
                                                      </tr>
                                                      
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                          
                                          
                                          <tr>
                                             <td style="font-size: 16px;padding: 40px 30px; text-size-adjust: 100%; border-collapse: collapse;" bgcolor="#FFFFFF" class="content">
                                                <?= isset($body['body']) ? $body['body'] : $body ?>
                                                
                                             </td>
                                          </tr>
                                          <?php if (isset($body['product']) && !empty($body['product'])): ?>
                                             <?php 
                                             $product = $body['product'];
                                             $image = $this->common_model->GetSingleData('product_image',array('product_id'=> $product['id'])); 
                                             $category = $this->common_model->GetSingleData('categories',array('id'=> $product['category'])); 
                                             ?>
                                          <tr style="margin: 20px 0;">
                                             <td style="padding:0;background-color:#ffffff" colspan="2" align="center" width="640" height="auto">
                                                <table border="0" cellspacing="0" cellpadding="0" align="center">
                                                   <tbody>
                                                      <tr>
                                                         <td align="center">
                                                            <table border="0" cellspacing="0" cellpadding="0" align="center">
                                                               <tbody>
                                                                  <tr>
                                                                     <td style="border-collapse:collapse;margin:0;padding:15px" align="left" width="260"><a href="<?= get_product_url($product) ?>" rel="noreferrer noopener" target="_blank" data-saferedirecturl=""><img style="display:block;border:none;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:22px;color:rgb(0,99,64);text-decoration:none;text-align:center;letter-spacing:1px;width:260px;max-width:800px" src="<?= base_url($image['image']) ?>?fit=fill&amp;bg=FFFFFF&amp;w=700&amp;h=500&amp;auto=format,compress&amp;trim=color&amp;q=90&amp;dpr=2&amp;updated_at=1652711257" alt="Jordan 4 Retro Military Black" class="CToWUd" data-bit="iit"></a></td>
                                                                     
                                                                     <td align="left" width="280">
                                                                        <table border="0" cellspacing="0" cellpadding="0" align="center">
                                                                           <tbody>
                                                                              <tr>
                                                                                 <td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:24px;color:#006340;text-decoration:none;text-align:left;line-height:30px;padding:30px 15px 15px 15px;font-weight:500" width="280"><a href="<?= get_product_url($product) ?>"><?= $product['title'] ?></a></td>
                                                                              </tr>
                                                                              
                                                                              <tr>
                                                                                 <td style="font-family:Arial,Helvetica Neue,Helvetica,sans-serif;font-size:13px;color:#000000;text-decoration:none;text-align:left;line-height:16px;font-weight:600;padding:0 0 0 15px" width="280">
                                                                                    <ul style="list-style-type:none;margin:0;padding:5px 0 0 0">
                                                                                       <li style="list-style-type:none;margin:0">FORMATE:&nbsp;<?= $product['format'] ?></li>
                                                                                       
                                                                                       <li style="list-style-type:none;margin:0">Category:&nbsp;<?= $category['title'] ?></li>
                                                                                       <li style="list-style-type:none;margin:0">RAM:&nbsp;<?= $product['ram'] ?></li>
                                                                                       
                                                                                       <!-- <li style="list-style-type:none;margin:0">Highest Bid:&nbsp;$2,160&nbsp;&nbsp;&nbsp; Lowest Ask:&nbsp;$2,290&nbsp;&nbsp;&nbsp; </li> -->
                                                                                    </ul>
                                                                                 </td>
                                                                              </tr>
                                                                              
                                                                           </tbody>
                                                                        </table>
                                                                     </td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                          <?php endif ?>
                                          <tr bgcolor="#ffffff">
                                             <td>
                                                <p style="font-size: 16px;color: #000;padding: 5px;font-weight: 600;margin-top: 10px;">Thank you,<br>Team <?= Project ?></p>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="border-collapse: collapse; padding: 15px; text-size-adjust: 100%;" align="center">
                                                <table style="border-collapse: collapse; table-layout: fixed;" border="0" width="100%" cellspacing="0" cellpadding="0">
                                                   <tbody>
                                                      <tr>
                                                         <td style="border-collapse: collapse; text-size-adjust: 100%;" align="center"><a href="<?= base_url() ?>" style="text-size-adjust: 100%; text-decoration: none; color: rgb(255, 96, 96);"><img style="display: block;border: none;font-family: ProximaNova, Helvetica, Arial, sans-serif;color: rgb(80, 158, 47);text-transform: none;font-size: 15px;letter-spacing: 1px;line-height: 25px;width: 120px;font-weight: 400;outline: none;" src="<?= base_url() ?>/assets/img/logo.png" alt="<?= Project ?>" width="65" height="auto"></a></td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                          
                                          
                                          
                                          
                                          <tr>
                                             <td style="padding: 0px 30px 30px; text-align: center; text-size-adjust: 100%; border-collapse: collapse;" width="640">
                                                
                                                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; table-layout: fixed;">
                                                   <tbody>
                                                      
                                                      
                                                      <tr>
                                                         <td style="font-family: ProximaNova, Helvetica, Arial, sans-serif; font-size: 10px; color: rgb(200, 193, 190); font-weight: 400; text-decoration: none; text-align: center; line-height: 12px; padding-top: 10px; text-size-adjust: 100%; border-collapse: collapse;" width="100%" site_name="">©2022 <?= Project ?>. All Rights Reserved.</td>
                                                      </tr>
                                                         
                                                      <tr>
                                                         <td style="font-family: ProximaNova, Helvetica, Arial, sans-serif; font-size: 10px; color: rgb(200, 193, 190); font-weight: 400; text-decoration: none; text-align: center; line-height: 12px; padding-top: 10px; text-size-adjust: 100%; border-collapse: collapse;" width="100%">The sender of this email is <?= Project ?> </td>
                                                      </tr>
                                                      
                                                   </tbody>
                                                </table>
                                                
                                             </td>
                                          </tr>
                                          
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>