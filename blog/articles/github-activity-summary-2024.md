If you consider commits to be a good metric of productivity, this year was huge. With an average of 1.7 commits per day (almost double my previous best), something about this year was clearly different. What do I credit? Monetization and LLMs.

There's a lot to cover this year, as always, I'll cover my work this year in chronological order, straying when it's narratively relevant.

## B-Rated

![Screenshot of B-rated (2024)](https://cdn.yiays.com/blog/b-rated-2024.webp)

This year started light with an experimental port of B-Rated to Godot Engine. This project has been pretty much untouched since [my last mention of it in the 2019 GitHub Activity Summary](https://yiays.com/blog/github-activity-summary-2019/#b-rated).

I had a go at creating a resizable game window with a GUI that is always pixel perfect. It's almost frictionless with Godot's GUI component.

I also ported over the character voices with pitch randomization, I made a start at the generative avatars system (this time as a GPU shader), and I had a go at a multiple-choice Dialogue Tree system.

I haven't made any start towards the player controller, tilemaps, and bee AI yet. So, this is technically reverse progress from 5 years ago, but working in this newer engine did go much faster. If I ever do dedicate a few months to this game, something interesting could come from it.

## Yiays.com

After last year's [database loss](https://yiays.com/blog/github-activity-summary-2023/#what-was-lost-with-the-sql-database), Yiays.com was sitting a little neglected, with no way for me to create new posts or edit existing ones. I threw together a file-based database for the blog last year, but this year, I brought back editing support, improved image handling and presentation, and improved the styling of the website overall.

### Design philosophy change

This year, I've improved page load in several instances, and I'm making a conscious effort to improve accessibility as well.

For example, on the [home page](/), I've removed the randomness of the selected blog posts and projects on the page, and now simply show a larger selection of relevant and recent items. I've stopped using horizontal scrolling when important information could be hidden as a result, and I've reduced cropping of thumbnails.

Another change which reflects this new design philosophy is the new hover animations. These will work well with both mouse and touch inputs, while continuing to avoid flashy animations with keyboard navigation.

![Old vs. new hover animations](https://cdn.yiays.com/blog/yiayscom-new-hover.webp)

The final change I'll mention today is turning "See the blog" and "See more projects" back into buttons. I've realized, making them look like just another project or blog post was misleading, when they should have more visual precedence. Now, they're buttons in their own vertical slice of the page, just like the action buttons in other parts of my website.

![Showing how buttons have been simplified and given more direct language](https://cdn.yiays.com/blog/yiayscom-new-buttons.webp)

## MerelyBot

My migration to Discord slash commands had started all the way back in 2021, but at the time, I prioritized ConfessionBot, as it was in active use in thousands of servers. This year, I finally finished the work on my original bot.

![](https://cdn.yiays.com/blog/merely-slash-help.webp)

I also added a powerful new module this year, `/controlpanel`. This new command removes the need for dozens of commands that simply toggle a feature on or off. ConfessionBot utilizes it very well.

![](https://cdn.yiays.com/blog/merely-controlpanel.webp)

The final noteworthy change for MerelyBot this year is the new `/download` command. This command downloads videos from almost any website and embeds it inside of Discord. You can see a demonstration of the feature [here](https://merely.yiays.com/#/download).

Download is the first premium feature for Merelybot. Which is a milestone, as it means now both of my bots have premium features that some users consider paying for. I don't make anywhere near enough to live off of, but it's nice to have this added security, and the hope that it might continue to grow in the future.

## ConfessionBot

This year, I fixed a maintenance headache that I've been living with for far too long. ConfessionBot and Merelybot used to share a single codebase, with ConfessionBot adding additional files that I wouldn't commit back to MerelyBot. As of February this year, I have finally switched to a filesystem overlay, where all ConfessionBot code exists in a separate folder, and MerelyBot overrides it's extensions, config, and translations by combining the two together in memory. [See the commit where all Merelybot code is removed from ConfessionBot's repo](https://github.com/yiays/ConfessionBot/commit/cdda8f427511ff6c1775d9fc25594d808028b469).

This change has completely removed merge conflicts from my life and made the sharing of improvements between Merelybot and ConfessionBot almost instant.

After this massive efficiency gain, ConfessionBot saw nearly 150 commits over the rest of the year, and a great number of new features. Too many to recount here, in fact. If you're curious at all, I'd recommend reading this blog post about [all of the new features added to ConfessionBot in 2024](https://yiays.com/blog/confessionbot-2024-overhaul/).

## MemeDB

Halfway through the year, I decided it was time to have another try at finishing my MemeDB rewrite. I've made some solid progress this year, but it's still not quite ready for launch.

![](https://cdn.yiays.com/blog/screenshots/meme1.webp)

The new MemeDB will allow users to search the database in any way they see fit. While memes will be even more searchable than ever, both on Google and within the site itself. With every meme getting descriptive titles based on whatever the best quality user input is available.

![](https://cdn.yiays.com/blog/screenshots/meme2.webp)

I'm sure the roughness of the interface is plain to see, but there's a lot of potential here, and now almost all of the core infrastructure is built.

![](https://cdn.yiays.com/blog/memedb-freeze-warning.webp)

At this stage, the original MemeDB is still up and running at [meme.yiays.com](https://meme.yiays.com), but the database is frozen, and no further changes are allowed. I hope you can see now, why I am fully commited to this rewrite.

## Passport

With this blog coming back to life, and the next project I needed to work on, it's time to fix Passport.

After the failure of my SQL database last year, I've been looking for free, cloud-hosted alternatives that are simpler than a great big SQL structure. For some of my other projects (MemeDB and Merely Music) I've settled on MongoDB for the readible and loosely structured JSON-based storage. But for this project (and Smartboard Games) I've stuck with Cloudflare Workers KV.

Simple KV storage alongside a Cloudflare Worker enables low latency secure storage all over the world. This also means, for simple applications, authentication and syncing can be done entirely client side, and all I need to do is host the client - and in the case of an app or PWA, not even that. All the while integrating this authentication and account control into more advanced full stack applications is still possible.

This new Passport is a complete rewrite. In a lot of ways, the scope is much smaller; I only intend for this authentication to work on yiays.com domains and apps. But with this comes a lot less red tape. Passport logins across yiays.com domains are now fully automatic. _However, at the time of writing, there still isn't any features available to everyday users._

All of this was necessary in order to urgently get on with my next project for the year.

## Merely Music

I got some rather unpleasant messages from the Play Developer Console this year (Google's dashboard for Android app developers). My developer license was going to be revoked in 60 days unless I can publish an app in this time.

I had an app in the early stages of prototyping, but it was nowhere near ready for a launch - or even a private alpha test. The app is Merely Music - my open source Google Play Music alternative I haven't touched since a rather stressful graduation in 2020. You can read about my experiences trying to make a website, app, database, cdn, and authentication framework in one semester [here](https://yiays.com/blog/github-activity-summary-2020/#merely-music).

Regardless, I didn't want to lose my developer license. So I pressed on and did as much work as I realistically could in 60 days. Starting with rewriting Passport (above), then rebuilding my app with the latest version of Expo and finalizing the structure of my database. It was an enormous amount of work, and the app still isn't ready for testing, but I managed to get an internal testing build listed on the Play store and completed all of my legal declarations for the app. This seems to have been enough for Google to allow me to keep my developer account for now.

In any case, I think the project is looking pretty good. You can see some screenshots on the project page [here](https://yiays.com/projects/#merely-music). In addition, here's one extra screenshot which shows a little more progress I've made and kept to myself thus far.

![](https://cdn.yiays.com/blog/merelymusic-library.webp)

> All the images shown here were created in Inkscape, then rasterized to WEBP. - It's nice to finally have a workflow for creating assets that doesn't involve any Adobe software!

## Conclusion

Not only was this one of the most productive years of my life, but this blog post is also probably one of the longest of my life as well. There's simply too much to discuss.

In the introduction paragraph, I mentioned that LLMs were a credit to my progress this year, yet there's not a single mention of how they helped throughout. That's because the help they give is invisible. I've used several LLMs throughout this year, like ChatGPT 4 & o1, Bing Chat, and Google Gemini. Whenever I'm stuck on a problem, these models help me get my thoughts in order and give me leads as to where my research should go next in order to solve a novel problem.

These models are also excellent at writing incredibly complex MongoDB Queries that I have no intention of creating from scratch. ChatGPT in particular has carried me through some incredibly difficult database queries where I need to join 5 or more tables with 4 filters and 2 sort heuristics. The complexity of MongoDB queries is truly horrific, and I'm glad I never have to touch them.

While Merely Music was once again stressful, the rest of the year was very enjoyable, and it's heartening to finally be getting some recognition financially. I hope to continue growing my software services over the next several years so I can one day have the flexibility to live anywhere and earn a living writing software I believe in.

If any of my work interests you and you would like to collaborate, support, or employ me, check out my [services page](/services/).