<head>
</head>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php $counter = 1; ?>
            <div class="scrollme">
                <table class="table" id="tableStyle" dir="ltr">
                    <thead>
                        <tr class="trStyle">
                            
                            <th class="font">#</th>
                            <th class="font">Name</th>
                            <th class="font">Genre</th>
                            <th class="font">Device</th>
                            <th class="font">Nft</th>
                            <th class="font">blockChain</th>
                            <th class="font">F2p</th>
                            <th class="font">P2e</th>
                            <th class="font">Description</th>
                            <th class="font">DigitalCurrency</th>

                        </tr>
                    </thead>
                    <tbody><?php $posts = get_posts([
                                'post_type' => 'book',
                                'post_status' => 'publish',
                                'numberposts' => -1
                                // 'order'    => 'ASC'
                            ]); ?>
                        <?php foreach ($posts as $key => $data) :
                            $post_date[$key] = $data->post_name; ?>
                            <tr id="trInformationStyle">
                                <td class=" tdStyle " style="width: 6%;">
                                    <div id="tableCounter">
                                        <a class="text-decoration-none text-muted" href="" id="w"><?php echo $counter ?> </a>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <div id="nameDivStyle">
                                        <img id="pictureStyle" src="<?php echo get_the_post_thumbnail_url($data->ID, 'medium'); ?>" width="100" height="200">
                                        <div id="nameStyle" class="wrapper"><a id="z" href="<?php echo $data->guid ?>"> <?php echo $post_date[$key] ?> </a></div>
                                    </div>
                                </td>
                                <td style="width: 5%;">
                                    <div class="wpStyle">
                                        <?php $args = array(
                                            'hide_empty' => 0,
                                        );
                                        $selected_term_id = array();
                                        $selected_term_id = wp_get_object_terms($data->ID, 'game_genre', array('fields' => 'ids'));
                                        if (!isset($selected_term_id)) {
                                            $selected_term_id[0] = 0;
                                        }
                                        foreach (get_terms('game_genre', array('hide_empty' => 0)) as $term) : ?>
                                            <p><?php foreach ($selected_term_id as $w) :  ?><?php if ($term->term_id == $w) { ?>
                                            <div><?php echo $term->name; ?></div><?php } ?>
                                    <?php endforeach; ?>
                                    </p>
                                <?php endforeach; ?>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <div class="wpStyle">
                                        <?php $args = array(
                                            'hide_empty' => 0,
                                        );
                                        $selected_term_id = array();
                                        $selected_term_id = wp_get_object_terms($data->ID, 'game_device', array('fields' => 'ids'));

                                        if (!isset($selected_term_id)) {
                                            $selected_term_id[0] = 0;
                                        }

                                        foreach (get_terms('game_device', array('hide_empty' => 0)) as $term) : ?>
                                            <p>
                                                <?php foreach ($selected_term_id as $w) : ?>
                                                    <?php if ($term->term_id == $w) { ?>
                                            <div>
                                                <?php echo $term->name; ?>
                                            </div>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    </p>
                                <?php endforeach; ?>
                                    </div>
                                </td>
                                <td style="width: 5%;">
                                    <div class="wpStyle">
                                        <?php $selected = wp_get_object_terms($data->ID, 'game_NFT', array('fields' => 'ids')); ?>
                                        <?php $selected_term_id = isset($selected[0]) ? $selected[0] : 0; ?>
                                        <?php foreach (get_terms('game_NFT', array('hide_empty' => 0)) as $term) : ?>
                                            <p>
                                                <?php if ($term->term_id == $selected_term_id) { ?>
                                            <div>
                                                <?php echo $term->name; ?>
                                            </div>
                                        <?php } ?>
                                        </p>
                                    <?php endforeach; ?>
                                    </div>
                                </td>
                                <td style="width: 5%;">
                                    <div class="wpStyle">
                                        <?php
                                        $selected = wp_get_object_terms($data->ID, 'blockChain', array('fields' => 'ids'));
                                        $selected_term_id = isset($selected[0]) ? $selected[0] : 0; ?>
                                        <?php foreach (get_terms('blockChain', array('hide_empty' => 0)) as $term) : ?>
                                            <p>
                                                <?php if ($term->term_id == $selected_term_id) { ?>
                                                    <?php $icon_url = hmic_get_term_meta($term->term_id, 'software_icon', true); ?>
                                                    <?php echo '<img title="' . $term->name  . $term->description . '" width="50" height="80" src="' . esc_url($icon_url) . '"/>'; ?>
                                                <?php } ?>
                                            </p>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td style="width: 5%;">
                                    <div class="wpStyle">
                                        <?php
                                        $selected = wp_get_object_terms($data->ID, 'game_F2P', array('fields' => 'ids'));
                                        $selected_term_id = isset($selected[0]) ? $selected[0] : 0; ?>
                                        <?php foreach (get_terms('game_F2P', array('hide_empty' => 0)) as $term) : ?>
                                            <p>
                                                <?php if ($term->term_id == $selected_term_id) { ?>
                                            <div>
                                                <?php echo $term->name; ?>
                                            </div>
                                        <?php } ?>
                                        </p>
                                    <?php endforeach; ?>
                                    </div>
                                </td>
                                <td style="width: 5%;">
                                    <div class="wpStyle">
                                        <?php
                                        $selected = wp_get_object_terms($data->ID, 'game_p2e', array('fields' => 'ids'));
                                        $selected_term_id = isset($selected[0]) ? $selected[0] : 0;
                                        ?>
                                        <?php foreach (get_terms('game_p2e', array('hide_empty' => 0)) as $term) : ?>
                                            <p>
                                                <?php if ($term->term_id == $selected_term_id) { ?>
                                            <div>
                                                <?php echo $term->name; ?>
                                            </div>
                                        <?php } ?>
                                        </p>
                                    <?php endforeach; ?>
                                    </div>
                                </td>
                                <td style="width: 18%;">
                                    <?php $txt =  get_post_meta($data->ID, '_hmci_discription')  ?>
                                    <?php if (!isset($txt[0]))  $txt[0] = "" ?>
                                    <div class="txt">
                                        <?php echo $txt[0] ?>
                                    </div>
                                </td>
                                <td style="width: 10%;">
                                    <?php $args = array(
                                        'hide_empty' => 0,
                                    );
                                    $selected_term_id = array();
                                    $selected_term_id = wp_get_object_terms($data->ID, 'DigitalCurrency', array('fields' => 'ids'));

                                    if (!isset($selected_term_id)) {
                                        $selected_term_id[0] = 0;
                                    }

                                    foreach (get_terms('DigitalCurrency', array('hide_empty' => 0)) as $term) : ?>
                                        <p>
                                            <?php foreach ($selected_term_id as $w) : ?>
                                                <?php if ($term->term_id == $w) { ?>
                                        <div>
                                            <?php
                                                    $url = 'https://api.bitpin.org/v1/mkt/currencies/';
                                                    $result = wp_remote_get($url);

                                                    $w = json_decode($result['body']);
                                                    // print_r($w);
                                                    foreach ($w->results as $a) {
                                                        if ($term->name == $a->title) {
                                                            if (isset($a->price_info->price)) {

                                                                echo ($term->name . ': ') . ($a->price_info->price . '$');
                                                            } else {

                                                                echo $term->name . ' not found';
                                                            }
                                                        }
                                                    }
                                            ?>
                                        </div>
                                    <?php } ?>
                                <?php endforeach; ?>
                                </p>
                            <?php endforeach; ?>

                                </td>
                            </tr>
                            <?php $counter += 1; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>