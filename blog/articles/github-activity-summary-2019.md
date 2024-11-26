In the past I didn't take data preservation very seriously, so much of my older work is lost - but 2019 is the year all of that changes as I make a concerted effort to add version control to all of my work and make it open source.

### [B-rated](https://github.com/yiays/b-rated)

![](https://cdn.yiays.com/blog/b-rated-title.webp)

B-rated was a top-down action RPG game that I was working on with 3 of my friends from the end of 2018 to the start of 2019. We dreamt up a colourful world with a branching storyline and witty dialogue. Probably not too disimilar from Undertale in terms of mechanics but with combat in the overworld, silky smooth vector graphics, and a responsive layout that would scale to any screen size, including mobile.

![](https://cdn.yiays.com/blog/b-rated-dialogue.webp)

From a programing standpoint, there was plenty of advanced techniques that I learned through this project, like drawing and animating triangle fans, some lightweight procedural generation, custom 2d character systems, synthetic voices for dialogue, and dynamic frame rate targeting. I even made a start on writing my own SVG renderer here. It's just a shame I wrote it all in the awful GameMaker: Studio 2 engine.

Using SVG files as sprites in any game engine is a challenge. They're not properly supported, and unoptimized assets can have a very high performance cost. So ultimately, most of the assets were rasterized.

A natural side-effect of working in with friends who are volunteering their time is many moving parts, any of which could lose interest and drop out at any time, and this is what happened with this project sadly. The concept was very interesting though and I may pick it back up at some point in a better engine. _Edit: I_ [_briefly_](https://github.com/yiays/b-rated) _had a go at rewriting this game in Godot Engine in 2024. Workflows and SVG support continue to be an obstacle, however._

### [KahootDiscord](https://github.com/yiays/noncopyrightedinternetquizgamename)

![](https://cdn.yiays.com/blog/kahoot-discord.webp)

KahootDiscord was another collaborative project, though this time it was just me and another fellow programmer.

We conceived of the idea of Kahoot in Discord voice chat together and worked on implementing it over several months in the middle of 2019.

Users could create their own questions, design answers and create collections of questions pertaining to a theme. Each question would be turned into an image that could be posted in a Discord channel. Anyone that wanted to participate would be sent a personalized link to a website where they can privately vote on an answer in real-time (the intention was to have users see the questions on their desktop and join the game on their phones so they could see both screens at the same time), as per the rules of Kahoot, the faster you answer a question correctly, the more points you get.

![](https://cdn.yiays.com/blog/kahoot-browser.webp)

We finished version 1.0 and played a few games with friends over the year, and it worked out okay. However, the poor performance of the Python runtime made for inaccurate time-based scoring, and the experience overall was quite unstable. Better tools exist these days for these types of experiences in Discord _(as of 2024)_ so if I were to revisit this, it would be done in a completely different way.

I ultimately shut this project down because of the instability and performance issues.

### [Merely](https://github.com/yiays/merely/)

2019 was also the year that I moved merelybot to GitHub. Before then, I had no version control at all and older work was lost. This was the year merely got integration with a music bot, a data-driven changelog, banning users from abusing the bot, and a powerful config module that can heal and migrate older config files to new versions.