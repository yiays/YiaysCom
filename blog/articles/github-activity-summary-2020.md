2020 was the last year of my studies, but despite the increased pressure of my final year of work for my degree, personal projects continued to grow in terms of both complexity and popularity over this year.

## PukekoHost

![](https://cdn.yiays.com/blog/screenshot-pukeko.yiays.com-2021.11.15-14_33_59.webp)

I started this year (and the end of the holidays) strong with a lofty goal; to collaborate with another developer to build a game hosting startup from the ground-up. Naturally, this was way too big of an undertaking to realistically pull off, but I'm still impressed with how far we got.

PukekoHost is a game hosting service with an entirely novel financing system; any member of a Discord server can chip in any small amount of money towards uptime - as little as an hour minimum - and uptime is only spent when users _want_ the server online.

We got so far as setting up a [GitHub Team](https://github.com/Pukeko-Host/), designing and implementing a [MySQL Database](https://github.com/Pukeko-Host/PukekoDB) for storing state and transactions, implementing a [Web UI](https://github.com/Pukeko-Host/PukekoWebUI) to advertise services, allow users to pick products and pricing, and provide a dashboard where they can control and monitor their servers, and a [Rust Service](https://github.com/Pukeko-Host/GSMS) that would take requests to spin-up servers, manage files, and forward stdin and stdout to the dashboard.

As with a lot of massive projects, integration hell ensued once we got as far as we did. Progress has since slowed to a crawl, I still hold out hope that we manage to finish it one day. You can visit the project in it's current state [here](https://pukeko.yiays.com).

## [MemeDB](https://meme.yiays.com/)

![](https://cdn.yiays.com/blog/screenshot-meme.yiays.com-2021.11.15-14_51_19.webp)

Moving on to the next massive project of this year, MemeDB is a database that attempts to organize memes into a massive database for searching and retrieval. Unlike PukekoHost, this project has been a resounding success; with the help of human input, [over 1000 memes are indeed searchable](https://meme.yiays.com/user/0/stats/) with the help of MemeDB. It's also became the best place for me to create a list of [favourite memes](https://meme.yiays.com/user/140297042709708800/favourites/) for sharing.

Like most of my projects, I'm once again using the LAMP stack to create a database and web UI. I'm also using a discord bot to accept submissions for memes, and a CDN I've built to download, compress and serve any memes that end up on the website.

MemeDB is also one of the biggest undertakings in SEO I've had, and it's been a success in that regard too; MemeDB has the most visitors out of any site I've made, followed closely by this blog of course.

While the site is still fully functional right now, it's mostly unmaintained as I continue to slowly work away at a rewrite. I aim to move the entire database to MongoDB and rewrite the WebUI in NEXT.js - there has been some progress, but it's far from ready to launch. Whatever state it is in, you can visit it [here](https://meme.yiays.com).

## Merely

Focus had shifted over this year, most components of Merely were somewhat polished or unused, so either way they didn't need much work. However, I started integrating Merely with other services of mine;

*   When memes are posted to certain channels, ️🔼 and 🔽 reactions would appear under them. Once a user upvotes a meme, it is added to MemeDB. From then onwards, any upvotes or downvotes are recorded and associated with their Discord IDs without them needing to visit the website.
*   Users could shorten links using my Link Shortener _(no longer running)_ service.
*   A [Merely website](https://merely.yiays.com) was created that shows the bot's stats, and documentation.
*   MemeDB can be searched, or random memes can be displayed, with commands in Discord.
*   Improved documentation of bot updates, add them to the website.
*   Early attempts at reducing the RAM usage of my bot by opting out of intents like members.

Early next year, work started on a complete rewrite, so a lot of these features remain in the pre-1.0 branch but never made it to future releases.

Regardless, I was happy to polish up this revision of MerelyBot before moving on. You can view the source code for this old branch [here](https://github.com/MerelyServices/Merely-Framework/tree/0.x).

## Google Play Music end of life

Google Play Music was a great service in it's time, providing cloud storage and sync of up to 10,000 songs and playlists and free offline play on your phone. For people that prefer to own their music rather than pay a subscription, it was fantastic and YouTube Music (_the service that was about to replace Google Play Music_) did not have a lot of the same features.

The support for uploaded music was sub-par (_even as of late 2024 there's still no way to edit metadata once you upload a song_) and if you ever choose to listen to music you don't own, not being allowed to turn the screen off so you can be served video ads seems like more of an insult than not offering free music full stop.

This disappointing news led me to taking on my next project, which you can read about below;

## [Merely Music](https://merely.yiays.com/music/)

For the last semester of my IT course, I was tasked with coming up with a project which I could thoroughly plan, document, and regularly provide progress reports to my tutor.

I decided to create a new website, app, database, CDN, and login framework. Altogether, I named this project Merely Music.

My plan is to create a login system named [Passport](https://passport.yiays.com), which could be reused for other projects. A MongoDB database, which could hold metadata, playlists, accounts, albums, and artists. A backend API which could store music files and control the database. And finally, an [Android, iOS, and Web app](https://github.com/MerelyServices/Merely-Music) using the Expo framework, which would be the front end.

_Edit: Passport has since been rewritten, it's no longer OAuth compliant, but it's very simple, and new integrations with the Blog and Merely Music are going very smoothly._

![](https://cdn.yiays.com/blog/screenshot-passport.yiays.com-2021.11.15-15_34_29.webp)

For those counting at home, this is essentially five separate projects. Naturally, I didn't get everything done in one semester. Far from it, in fact.

2 months were spent planning, the remaining 4 months were spent implementing the Passport website and API, the database schema, and creating the workflow for building and testing the frontend. I was quite burnt out by the end of it, but some good did come from it; my blog has a working login system, and the bones of a Music streaming service are very much in place.

_Edit: work on Merely Music has continued, there will be a lot more to show in the upcoming GitHub Activity Summary 2024 article._

## ConfessionBot

2020 was also a big year for [ConfessionBot](https://yiays.com/blog/confession-bot-a-side-project/), this bot (which was originally a commission only intended for one Discord server) exploded in popularity.

I had to build out a support server and add translation support in a hurry to scale this bot up for wider use in the Discord community. Translation support was surely worth it, too, as 5 contributors have added a total of 5 languages to ConfessionBot's belt.

At this time, ConfessionBot was a monolithic codebase without any version control. It was built entirely from scratch using the Discord.py framework.

Here were the main changes this year.

*   Translation support with INI files. They supported inheritance, so missing strings would fall back to another file.
*   Added a 3rd channel type, Vetting channels. These intercept messages before being posted publicly, requiring a moderator to approve or deny them first.

## Conclusion

2020 was a huge year in terms of raw output. I had a habit of switching projects whenever I hit a wall, and I think this shows here.

This was also a time when there were very few distractions in my life. Looking back at it, this year is always a little surprising to me how much I did.