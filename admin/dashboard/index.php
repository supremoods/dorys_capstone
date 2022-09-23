<?php
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header("Location: /admin");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/templates/header_links.php')?>
    <link rel="stylesheet" href="/vendors/css/admin/global.css">
</head>
<body class="bg-light">
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/admin/templates/header.php')?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro velit sunt praesentium vitae quibusdam illo quae quos magni, deleniti modi, earum nulla eius minima excepturi expedita animi? Incidunt iste facere voluptatem dignissimos consequuntur ut tenetur alias commodi ipsam dolor, ex necessitatibus consequatur quibusdam, inventore ullam praesentium saepe, deleniti quaerat sequi! Quis aliquam quod perferendis rerum nesciunt eligendi laborum voluptatum beatae libero sapiente dolores, neque magni enim officia ut, quae delectus laboriosam iste nam, consequuntur sed? Est doloribus asperiores vero inventore, vitae magnam itaque, odit ab dolore nostrum nam fugit reiciendis doloremque a? Quas culpa quaerat exercitationem sapiente neque cupiditate aperiam quia labore consequatur itaque! Aspernatur consequuntur nesciunt odio quos velit nostrum non ea delectus? Voluptate dolore iusto sunt sequi quibusdam quam id quisquam enim molestias deserunt magnam libero totam consequatur quos excepturi, tempora eveniet voluptas beatae hic. Deserunt iure quis nostrum nisi veniam repudiandae rem consequatur distinctio velit, voluptate dolorem aliquam autem earum possimus mollitia quidem doloremque accusamus tempore blanditiis! Facere hic praesentium vero cum voluptate magnam tenetur sapiente, iste placeat ipsa sequi voluptatem dolor enim, eveniet neque aspernatur architecto pariatur nobis voluptatibus? Similique quidem saepe, labore reprehenderit animi eos, pariatur dolor accusamus numquam soluta voluptatum aut. Facilis, dolore voluptatem. Excepturi totam incidunt laboriosam possimus obcaecati ipsam, facere ex eligendi corporis ipsum aliquid porro, nostrum autem veniam optio hic odit delectus, beatae doloremque modi. Similique ex eum nisi sunt? Quidem tempora saepe at atque doloremque beatae quam aliquid ut magni alias accusamus consequuntur adipisci dolore aspernatur maiores architecto sequi fugit libero dolorum ullam amet, molestiae, explicabo culpa accusantium. Dolore ipsum officiis autem odio nam repellendus quos, vitae quia quae corporis quaerat harum optio sint enim vel quis repellat voluptatem. Aut itaque at architecto sunt provident nam quam modi eveniet aspernatur reprehenderit doloremque tempore laboriosam, voluptate perferendis ut commodi odio ab impedit non officiis nemo quae assumenda natus officia? Eaque, ea. Quod dolores dolore, laudantium, quo ipsum sapiente dolor, laborum sed beatae accusantium doloribus mollitia. Recusandae adipisci, minima quod quo eius quae sequi ipsam omnis quisquam laudantium officiis obcaecati eos nulla aliquam ut consectetur dolorem voluptates culpa. Fugit provident alias consequuntur, necessitatibus, totam quo inventore nisi maiores nam magni consequatur molestias ducimus sit exercitationem cum pariatur laudantium commodi. Minima illo laborum voluptas, ex harum sapiente iusto dolorum obcaecati expedita provident quis dicta qui deserunt sit error. Quasi nostrum necessitatibus molestias voluptatum temporibus exercitationem, aut beatae vel corrupti officia officiis consequuntur ea alias sint deserunt rem nisi sed cupiditate nam recusandae sunt saepe. Facilis numquam velit est tempora sint deleniti, magnam dolorum inventore in praesentium nihil voluptas eius, delectus doloribus vitae corporis unde vel eos. Hic dignissimos at aliquid repudiandae debitis. Inventore aut voluptatem quae voluptatibus. Magni, hic labore blanditiis enim consequatur recusandae, doloremque iure totam, rem deleniti unde. Neque eligendi est aut, ratione cumque veritatis dolorem ab facere vel, cum quidem rerum blanditiis cupiditate expedita ut et perferendis saepe voluptatem natus explicabo facilis. Accusantium adipisci totam labore deleniti sint eveniet! Accusantium esse sint culpa eius! Mollitia sunt doloribus ipsa. Doloremque, earum.
            </div>
        </div>
    </div>
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/templates/footer_scripts.php')?>
    <script src="/vendors/js/admin/dashboard.js"></script>
    <script src="/vendors/js/admin/authentication/auth_logout.js"></script>
</body>
</html>