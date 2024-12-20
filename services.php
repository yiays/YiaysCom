<?php
require_once('router.php');

$title = "Services";
$desc = "Work with Yiays to build your next project or contribute funds towards improving an existing project you use.";
$keywords = "employ, commission, hire, freelance, support, fund, Patreon, subscription, chatbot, website, app, database, program";
require('includes/header.php');
?>
<article class="hero" style="background:#2B365D;">
  <h1>Services</h1>
  <p>
    Work with Yiays to build your next project - be it web, desktop, mobile, or a chatbot -
    or contribute funds towards improving an existing project you use.
  </p>
</article>
<hr>
<section>
  <h2>Hire</h2>
  <p>
    I'm available for full-time or part-time work right now. If you're potentially interested,
    I have a LinkedIn where you can find out more about my professional experience.
  </p>
  <div class="flex-row">
    <a class="btn" href="https://linkedin.com/in/yiays/" target="_blank">View my LinkedIn</a>
  </div>
</section>
<hr>
<section>
  <h2>Freelance</h2>
  <p>
    Looking to commission a website, app, or bot? Contact me for a quote. If you're looking to
    own a customized version of an existing project of mine it could work out to be incredibly
    affordable. <i>I also provide hosting solutions!</i>
  </p>
  <div class="flex-row">
    <a class="btn" href="mailto:yiays@yiays.com">Contact me via email</a>
  </div>
</section>
<hr>
<section>
  <h2>Support development</h2>
  <p>
    A small monthly subscription can help fund professional translations and focus my development
    efforts on projects you use. You can also enjoy premium features as they're added to my
    projects.
  </p>
  Projects that currently have Patreon benefits;
  <ul>
    <li><a href="/projects/#cb">ConfessionBot</a> - Compact mode, confession branding</li>
    <li><a href="/projects/#merely">merelybot</a> - Download command</li>
    <li><a href="https://discord.gg/ejR6Egqcdn" target="_blank">Yiays Bot Support</a> (Discord Server) - Priority support</li>
    <li><i>Custom Discord bots developed and hosted for you.</i> - Requires the higher Patreon tier</li>
  </ul>
  <div class="flex-row">
    <a class="btn" href="https://www.patreon.com/yiays" target="_blank">Support my projects on Patreon</a>
  </div>
</section>
<?php
require('includes/footer.php');
?>