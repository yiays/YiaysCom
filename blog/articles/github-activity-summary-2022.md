As I often like to do, I'll give this year a theme, _users_. I got plenty of experience pushing projects to production and working directly with my users this year.

## Babel Translator

![](https://cdn.yiays.com/blog/babel-translator.webp)

[Babel Translator](https://yiays.com/projects/#translator) is a tool for editing string files in my Babel-Lang format. Babel-Lang is an INI-based string format with inheritance that enables a few of my projects to be easily translated.

The translation tool itself is relatively simple. Written purely in jQuery, it connects to GitHub, fetches the latest files, parses them, and provides the translators with a GUI which helps them find strings in need of updating.

Beyond the core functionality, I've also added offline capabilities, autosaving, and caching - this helps avoid GitHub rate limits - as well as native window bars using the new standard. At this stage, it meets most of the criteria to be a PWA short of working on mobile and having an icon. I had to learn a lot about new technologies to make this possible, these new technologies make me very excited about the future of the web.

In the future, I'd like to make it possible to submit translations within the web app and add support for mobile phones.

## Smartboard Games

![](https://cdn.yiays.com/blog/smartboard-games.webp)

During 2022, I was an assistant caretaker in an afterschool programme. I spent my time teaching maths, programming, and I also made a collection of educational games designed for use with smartboards, tablets, and computers.

The website is entirely static with high scores being provided by Cloudflare Workers. The games and tools use preloading and loading screens where appropriate to keep things fair as well.

Since my place of work was in the classroom, I was able to prototype and test rapidly - and receive valuable user testing experience as well.

## Discord Bots

![](https://cdn.yiays.com/blog/slash-command-example.webp)

[Discord started restricting access to message content](https://yiays.com/blog/github-activity-summary-2021/#a-retrospective-on-discord-bot-drama) halfway through this year. This made most Discord bots made before slash commands were implemented non-functional. I've been slowly migrating towards slash commands with MerelyBot and ConfessionBot for 8 months at the time; but when the due date drew close in March, I was still rushing to meet it.

Many developers were not happy about this change, but at least for my needs it has been a massive help. It makes invalid commands impossible for users to send. This reduces error checking, and drastically reduces the bandwidth, memory, and cycles used by large Discord bots. Before, ConfessionBot would crash frequently on my server when it was part of 8000 Discord Servers - now, it's sitting comfortable with plenty of headroom at 18,000.

## Private commissions

![](https://cdn.yiays.com/blog/scheduleshop.webp)

My first major commission was completed this year. I worked full time for 2 weeks building an enrolment website for an educational institute. This website collects contact information and names of students, helps parents build a custom timetable, and dynamically adjusts promotional pricing in real time according to the active promotions, their criteria, and input from the parents.

Once a quote has been generated - if a parent wants to move forward - the website sends a nicely formatted email to the enrolments office.

## Conclusion

This year was very different from any in the past in terms of workflows, communication, and deadlines. It felt like I was finally working professionally. While these projects have all more or less been finished, more will come in the following years, and I hope they will be more like this.