<?php

$show = isset($_GET['show']) ? $_GET['show'] : false;
if ($show) {
    $ob = $this->db->get_where('helpdata', array('id' => $show))->row();
    // print_r($ob);
?>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div style="background: #fff; padding: 15px;">
                <a href="<?= admin_url('dashboard/contact-messages'); ?>" class="btn btn-info">Go Back</a>
                <h2>Message Details</h2>
                <table class="table table-striped">
                    <tr>
                        <td>Chapter</td>
                        <td class="text-right"><?= $ob->chapter_id; ?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td class="text-right"><?= $ob->youname; ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td class="text-right"><?= $ob->country; ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td class="text-right"><?= $ob->statenm; ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td class="text-right"><?= $ob->citynm; ?></td>
                    </tr>
                    <tr>
                        <td>Email Id</td>
                        <td class="text-right"><?= $ob->email; ?></td>
                    </tr>
                    <tr>
                        <td>Contact No</td>
                        <td class="text-right"><?= $ob->phone; ?></td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td class="text-right"><?= $ob->title; ?></td>
                    </tr>
                    <tr>
                        <td>About Project</td>
                        <td class="text-right"><?= $ob->about_project; ?></td>
                    </tr>
                    <tr>
                        <td>Url</td>
                        <td class="text-right"><a href="<?= $ob->url; ?>"><?= $ob->url; ?></a> </td>
                    </tr>
                    <tr>
                        <td>About Me</td>
                        <td class="text-right"><?= $ob->about_me; ?></td>
                    </tr>
                    <tr>
                        <td>How will you use the money?</td>
                        <td class="text-right"><?= $ob->use_for_money; ?></td>
                    </tr>

                    <tr>
                        <td>How does your project impact Red Sled Santa Foundation?</td>
                        <td class="text-right"><?= $ob->extra_answer_1; ?></td>
                    </tr>
                    <tr>
                        <td>How did you hear about Awesome Red Sled Santa Foundation?</td>
                        <td class="text-right"><?= $ob->extra_answer_2; ?></td>
                    </tr>
                    <tr>
                        <td>Attachment</td>
                        <td class="text-right">
                            <?php
                            if ($ob->images != '') {
                                $ar = json_decode($ob->images);
                                foreach ($ar as $nm) {
                                    echo anchor(base_url(upload_dir($nm)), $nm, array('target' => '_blank'));
                                    echo "<br />";
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Created</td>
                        <td class="text-right"><?= date('Y-m-d', strtotime($ob->created)); ?></td>
                    </tr>
                </table>
                <a href="<?= admin_url('dashboard/delete-messages/' . $ob->id); ?>" class="btn btn-danger delete">Delete</a>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-head">
                    Contact Messages
                </div>
                <?php
                $arrMsg = $this->db->order_by('id', 'DESC')->get("helpdata")->result();
                // print_r($arrMsg[0]);
                ?>
                <div class="widget-content">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name, Email</th>
                                <th>Contact No</th>
                                <th>Country</th>
                                <th>State & City</th>
                                <th>Project name</th>
                                <th>About Project</th>
                                <th>Created</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sl = 1;
                            foreach ($arrMsg as $ob) {
                            ?>
                                <tr>
                                    <td><?= $sl++; ?></td>
                                    <td><?= $ob->youname . ' ' . $ob->email; ?> </td>
                                    <td><?= $ob->phone; ?> </td>
                                    <td><?= $ob->country; ?> </td>
                                    <td><?= $ob->statenm . ', ' . $ob->citynm; ?> </td>
                                    <td><?= $ob->title; ?></td>
                                    <td><?= $ob->about_project; ?></td>
                                    <td><?= date('Y-m-d', strtotime($ob->created)); ?></td>
                                    <td>
                                        <a href="<?= admin_url('dashboard/contact-messages/?show=' . $ob->id); ?>" class="btn btn-xs btn-info">View</a>
                                        <a href="<?= admin_url('dashboard/delete-messages/' . $ob->id); ?>" class="btn btn-xs btn-danger delete">DEL</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
}
