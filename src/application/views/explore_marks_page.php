<?php $this->load->view('includes/header'); ?>

<?php if(isset($tips)): ?>
	<div class="alert alert-dismissible alert-info">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php echo $tips ?>
	</div>
<?php endif ?>

<?php if(0): ?>

<br/>

<div class="container">
  <table class="table table-striped table-hover ">
  	<thead>
  		<tr>
  			<th>
          <?php echo lang('value')?>
        </th>
  			<th>
  				<?php echo lang('name')?>
  			</th>
  			<th>
  				<?php echo lang('tag')?>
  			</th>
  			<th><?php echo lang('contributor') ?></th>
  			<th><?php echo lang('action') ?></th>
  		</tr>
  	</thead>
  	<tbody>
  		<?php foreach ($marks as $key => $mk):?>
  			<tr>
  				<td>
            <div class="btn-group-vertical">
  					  <?php
    					if(isset($user_id)){
                $query=$this->db->select('type')->where('user_id', $user_id)->where('mark_id', $mk->mark_id)->get('vote');
      					$avote =$query->row();
              }
              else $avote = null;
              ?>
              <?php echo anchor('user/vote_mark/1/'.$mk->mark_id, '<i class="fa fa-chevron-up"></i><br/>'.$mk->value,'class="btn btn-xs '.(($avote&&$avote->type==1)?'btn-primary':'').'"' ); ?>
              <?php echo anchor('user/vote_mark/-1/'.$mk->mark_id, '<i class="fa fa-chevron-down"></i>','class="btn btn-xs '.(($avote&&$avote->type==-1)?'btn-primary':'').'"' ); ?>
            </div>
  				</td>
  				<td>
            <p><?php echo $mk->title ?></p>
            <p><?php echo anchor($mk->url, $mk->url);?></p>
  				</td>
  				<td><?php foreach ($tags[$key] as $tag): ?>
  						<?php echo anchor('explore/tag_search_marks/'.$tag->tagid.'/'.$theme_id, $tag->tag_name, 'class="btn btn-primary btn-xs"');?>
  					<?php endforeach;?>
  				</td>
  				<td><?php echo anchor('user/'.$mk->contributor, $mk->username.'('.$mk->contribution).')';?></td>
  				<td>
  				<div class="btn-toolbar">

  					  <div class="btn-group">
                <div class="btn-group">
                <a href="#" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                  <?php echo lang('vote');?>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <?php echo anchor('user/vote_mark/1/'.$mk->mark_id, lang('upvote'));?>
                  </li>
                  <li>
                    <?php echo anchor('user/vote_mark/-1/'.$mk->mark_id, lang('downvote'));?>
                  </li>
                <!--<li>
                    <?php echo anchor('#', lang('cancel'));?>
                  </li> -->
                 </ul>
              </div>
  					  
  					  <div class="btn-group">
  					  			<!-- Button trigger modal -->
  <!--                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    </button> -->
  					    <?php echo anchor('user/new_tag/'.$mk->mark_id.'/'.$theme_id, lang('add_tag'), 'class="btn btn-xs"');?>
  					  </div>
  					
  					</div>
  				</td>
  			</tr>
  		<?php endforeach;?>
  	</tbody>
  </table>
</div>

<?php $this->load->library('form_validation') ?>
<!-- Modal -->
<?php echo form_open('user/add_tag/');?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('new').' '.lang('theme') ?></h4>
      </div>
      <div class="modal-body">

    <div class="form-group">
      <div class="input-group">

        <?php echo lang('name', 'focusedInput', 'class="control-label"');?>
        <?php echo form_input('name', set_value('name'), 'class="form-control" id="focusedInput"');?>
      </div>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          <?php echo lang('close') ?>
        </button>
        <?php echo form_submit('submit', lang('submit'), 'class="btn btn-primary"');?>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>

<?php else: ?>

<br>
<br>

<div class="container">
  <div class="row">

    <?php foreach ($marks as $key => $mk):?>
    <div class="col-lg-4 col-sm-6">
      <h4>
        <!-- icon -->
        <?php echo anchor($mk->url, $mk->title);?>
      </h4>
      <p>
        <?php echo '<i class="fa fa-user"></i> '.$mk->username.'('.$mk->contribution.')' ?>
        <div class="btn-group">
          <?php
          if(isset($user_id)){
            $query=$this->db->select('type')->where('user_id', $user_id)->where('mark_id', $mk->mark_id)->get('vote');
            $avote =$query->row();
          }
          else $avote = null;
          ?>
          <?php echo anchor('user/vote_mark/1/'.$mk->mark_id, $mk->value.' <i class="fa fa-chevron-up"></i>','class="btn btn-xs '.(($avote&&$avote->type==1)?'btn-primary':'').'"' ); ?>
          <?php echo anchor('user/vote_mark/-1/'.$mk->mark_id, '<i class="fa fa-chevron-down"></i>','class="btn btn-xs '.(($avote&&$avote->type==-1)?'btn-primary':'').'"' ); ?>
        </div>
        <?php foreach ($tags[$key] as $tag): ?>
          <?php echo anchor('explore/tag_search_marks/'.$tag->tagid.'/'.$theme_id, $tag->tag_name, 'class="btn btn-primary btn-xs"');?>
        <?php endforeach;?>
        <?php echo anchor('user/new_tag/'.$mk->mark_id.'/'.$theme_id, '<i class="fa fa-tag"></i>','class="btn btn-xs"')?>
      </p> 
    </div>
    <?php endforeach ?>

  </div>
</div>

<?php endif ?>

<?php $this->load->view('includes/footer'); ?>