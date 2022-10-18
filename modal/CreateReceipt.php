<!-- create print receipt reservation  -->

<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/admin_model/SqlQuery.php');

    class CreateReceipt extends SqlQuery{
        public function fetchRow(){
            $result = $this->fetchClients();
            $count = 0;
            while($row = $result->fetch_assoc()){
?>
                    <tr>
                        <th scope="row" class="id"><?=$count+=1?></th>
                        <td><img src="../../vendors/images/clients/<?=$row['avatar']?>" alt="" class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                        <td><?=$row['fullname']?></td>
                        <td><?=$row['email']?></td>
                        <td><?=$row['address']?></td>
                        <td><?=$row['number']?></td>
                        <td><span class="badge bg-success"><?=$row['status']?></span></td>
                        <td>
                            <button class="btn btn-sm btn-success" data-id="<?=$row['user_token']?>" onclick="ViewDetails (this.dataset.id)">View Details</button>
                            <button class="btn btn-sm btn-danger"  data-id="<?=$row['user_token']?>">Delete</button>
                        </td>
                    </tr>

<?php

            }
        }
    }

    $createReceipt = new CreateReceipt;
    $createReceipt->fetchRow();

    






