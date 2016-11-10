
  <div class="row">
    <div class="col-lg-4 col-md-6 col-xs-12">
      <div class="block block-default">
        <div class="block-heading">
          <h4>Headers</h4>
        </div>
        <div class="block-body">
          <h1>Header 1
             <small>Sub-header</small>
          </h1>
		  <blockquote>
             <?php
				echo htmlspecialchars("<h1>Header 1 <small>Sub-header</small></h1>");
			 ?>
          </blockquote>
          <h2>Header 2
             <small>Sub-header</small>
          </h2>
		  <blockquote>
             <?php
				echo htmlspecialchars("<h2>Header 2<small>Sub-heading</small></h2>");
			 ?>
          </blockquote>
          <h3>Header 3
             <small>Sub-header</small>
          </h3>
		  <blockquote>
             <?php
				echo htmlspecialchars("<h3>Header 3<small>Sub-heading</small></h3>");
			 ?>
          </blockquote>
          <h4>Header 4
             <small>Sub-header</small>
          </h4>
		  <blockquote>
             <?php
				echo htmlspecialchars("<h4>Header 4<small>Sub-heading</small></h4>");
			 ?>
          </blockquote>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-xs-12">
      <div class="block block-default">
        <div class="block-heading">
          <h4>Paragraphs</h4>
        </div>
        <div class="block-body">
          <p>This is an example of standard paragraph text. This is an example of <a href="#" class="underlinehover">link anchor text</a> within body copy.</p>
		  <blockquote>
             <?php
				echo htmlspecialchars("<a href=\"#\" class=\"underlinehover\">link anchor text</a> ");
			 ?>
          </blockquote>
          <p>
             <small>This is an example of small, fine print text.</small>
          </p>
		  <blockquote>
             <?php
				echo htmlspecialchars("<small>This is an example of small, fine print text.</small>");
			 ?>
          </blockquote>
          <p>
             <strong>This is an example of strong, bold text.</strong>
          </p>
		  <blockquote>
             <?php
				echo htmlspecialchars("<strong>This is an example of strong, bold text.</strong>");
			 ?>
          </blockquote>
          <p>
             <em>This is an example of emphasized, italic text.</em>
          </p>
		  <blockquote>
             <?php
				echo htmlspecialchars("<em>This is an example of emphasized, italic text.</em>");
			 ?>
          </blockquote>
          <br>
          <h4>Alignment Helpers</h4>
          <p class="text-left">Left aligned text.</p>
          <p class="text-center">Center aligned text.</p>
          <p class="text-right">Right aligned text.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-xs-12">
      <div class="block block-default">
        <div class="block-heading">
          <h4>Blockquotes</h4>
        </div>
        <div class="block-body">
          <h4>Default Blockquote</h4>
          <blockquote>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          </blockquote>
          <h4>Blockquote with Citation</h4>
          <blockquote>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
             <small>Someone famous in Source Title</small>
          </blockquote>
          <h4>Right Aligned Blockquote</h4>
          <blockquote class="pull-right">
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          </blockquote>
        </div>
      </div>
    </div>
    <div class="col-lg-5 col-md-6 col-xs-12">
      <div class="block block-default">
        <div class="block-heading">
          <h4>Links</h4>
        </div>
        <div class="block-body">
          <a href="#" class="">default</a>
          <br><br>
          <a href="#" class="underlinehover">underlinehover (hover and focus)</a>
          <br><br>
          <a href="#" class="link_uppercase">link_uppercase</a>
          <br><br>
          <a href="#" class="link_lowercase">link_lowercase</a>
        </div>
      </div>
    </div>
  </div>
