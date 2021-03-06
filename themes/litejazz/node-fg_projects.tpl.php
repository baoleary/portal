<script type="text/javascript">
$(document).ready(function() {
	$('.accordian').each(function() {
		$(this).hide();
	});

	$('.accordian_header').click(function() {
		$(this).next('div').toggle();
	});
});
</script>

<style>
.accordian {
	display: none;
}
</style>

<div class="node<?php print " $classes"; ?><?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?>">
  <?php if ($picture) { print $picture; }?>

  <?php if ($page == 0) { ?>
    <?php if ($title) { ?>
      <h2 class="title"><a href="<?php print $node_url?>"><?php print $title?></a></h2>
    <?php }; ?>
  <?php }; ?>

  <?php if ($node->project_admin_view && $submitted) { ?>
    <span class="submitted"><?php print $submitted?></span> 
  <?php }; ?>

  <?php foreach($node->taxonomy as $term) { ?>
    <span class="taxonomy"><?php print l($term->name, "projects/" . $term->name); ?></span>
  <?php }; ?>

  <div class="content">
  	<?php if (fg_phase_2_fg_projects_join_access($node)) : ?>
			<div class="project-join">
				<?php print l(t('Join this project'), "node/$node->nid/join-project"); ?>
			</div>
  	<?php endif; ?>
  	<h3>Project Details</h3>
  	<dl>
  		<dt>Project Lead</dt>
  		<dd><?php print theme('user_fullname', $node->field_project_lead[0]['uid']); ?>&nbsp;</dd>
  		
  		<dt>Project Manager</dt>
  		<dd><?php print theme('user_fullname', $node->field_project_manager[0]['uid']); ?>&nbsp;</dd>
  		
			<?php if ($node->field_project_members[0]['uid']) : ?>
				<dt>Project Members</dt>
				<dd>
					<?php
						$members = array();
						foreach ($node->field_project_members as $member) {
							$members[] = theme('user_fullname', $member['uid']);
						}
						print implode(', ', $members);
					?>
					&nbsp;
				</dd>
			<?php endif; ?>
  		
			<?php if ($node->field_project_expert[0]['uid']) : ?>
				<dt>Supporting Experts</dt>
				<dd>
					<?php
						$experts = array();
						foreach ($node->field_project_expert as $expert) {
							$experts[] = theme('user_fullname', $expert['uid']);
						}
					print implode(', ', $experts);
					?>
					&nbsp;
				</dd>
			<?php endif; ?>

  		<dt>Institution</dt>
  		<dd>
  			<?php
  				$user = user_load($node->field_project_lead[0]['uid']);
					$org = $user->profile_organization;
					$inst = $user->profile_institution_name;
					$org = $org . ", " . $inst;
					if (strcmp($org, "Please signup, Please sign up") == 0) {
						$contact = $node->field_project_contact[0]['value'];
						$firstmark = "Organization: ";
						$lastmark = "Institution: ";
						$firstmarkStart = strpos($contact, $firstmark);
						$lastmarkStart = strpos($contact, $lastmark);
						if ($firstmarkStart > 0 && $lastmarkStart > 0) {
							$firstStart = $firstmarkStart + strlen($firstmark);
							$lastStart = $lastmarkStart + strlen($lastmark);
							$firstAlt = trim(substr($contact, $firstStart, strpos($contact, $lastmark) - $firstStart));
							$lastAlt = trim(substr($contact, $lastStart, strlen($contact) - $lastStart));
							if (!strcmp($lastAlt, "") == 0) {
								$org = check_plain($firstAlt . ", " . $lastAlt);
							} else {
								$org = check_plain($firstAlt);
							}
						} else {
							$org = '';
						}
					}
					print $org;
  			?>
  			&nbsp;
  		</dd>
  		
  		<dt>Discipline</dt>
  		<dd><?php print $node->field_project_primary_discipline[0]['view']; ?>&nbsp;</dd>
  		
  		<?php if ($node->field_project_sec_discipline[0]['view']) : ?>
				<dt>Subdiscipline</dt>
				<dd><?php print $node->field_project_sec_discipline[0]['view']; ?>&nbsp;</dd>
			<?php endif; ?>
  		
  	</dl>
  	
  	<h3>Abstract</h3>
  	<p><?php print $node->field_project_abstract[0]['view']; ?></p>
  	
  	<h3 class="accordian_header">Intellectual Merit</h3>
	<div class="accordian">
  	<p><?php print $node->field_project_merit[0]['view']; ?></p>
	</div>
  	
  	<h3 class="accordian_header">Broader Impacts</h3>
	<div class="accordian">
  	<p><?php print $node->field_broader_impact[0]['view']; ?></p>
	</div>
  	
  	<h3 class="accordian_header">Scale of Use</h3>
	<div class="accordian">
  	<p><?php print $node->field_project_scale[0]['view']; ?></p>
	</div>
  	
  	<?php if ($node->field_project_results[0]['view']) : ?>
  		<h3 class="accordian_header">Results</h3>
			<div class="accordian">
			<p><?php print $node->field_project_results[0]['view']; ?></p>
			</div>  		
  	<?php endif; ?>

  </div>
  
  <div class="clear-block clear"></div>

  <?php if ($links): ?>
    <div class="links">&raquo; <?php print $links; ?></div>
  <?php endif; ?>

</div>
