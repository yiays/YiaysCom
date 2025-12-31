2025 has been a slower year than the last, mostly because of struggles in the real world keeping me busy. Nevertheless, there's plenty of interesting projects that came to fruition this year. I published my first apps to the Google Play Store and Windows winget repo this year, for example.

## [Smartboard Games](https://games.yiays.com)

![The overhauled homescreen of Smartboard Games](https://cdn.yiays.com/blog/smartboard-games-2025.webp)

> Smartboard Games continues to be my favourite springboard for making simple games in a matter of weeks.

Two new games have been added to Smartboard Games this year; Marbles - a water sort puzzle game - and Flashcards Quiz - an improved version of Flashcards with a scoring system and leaderboards.

These games suit themselves well to being played on a phone casually over the day, so I added the capability to install Smartboard Games as a PWA app, I also added offline support - so now most of the games will continue to work just fine even if you go out of range.

Through this project, I'm maintaining my knowledge of modern web standards and continuing to learn more. I've learned how to use broadcast channels to communicate between threads in Javascript, leveraging CSS variables and animations to write as little Javascript as possible, and creating a mobile app using PWA standards.

Smartboard Games is available ad-free on the [official website](https://https).

## ConfessionBot

![Screenshot shows a custom /whisper command being added using the control panel](https://cdn.yiays.com/blog/confessionbot-custom-command.webp)

There's not much to report with ConfessionBot this year, two new features were added; custom confess commands, and support for sending confessions to threads.

All command names and descriptions can now be translated, too, though this has yet to have been taken advantage of by the translators.

ConfessionBot continues to be my highest grossing project, and I continue to provide fast support and patches, but as of right now I don't have any ideas for significant improvements or new features.

If you would like to learn more or add ConfessionBot to your server, read more [here](https://yiays.com/blog/confessionbot-2024-overhaul/).

## AutoLogout

![](https://cdn.yiays.com/blog/autologout.webp)

> I haven't mentioned AutoLogout before because it was a crude countdown timer which logs the user out or shuts the computer down before, but now it's an advanced parental controls tool for Windows with a mobile companion app.

AutoLogout started out as a simple timer for a guest account on a computer I share with younger siblings, but always with the ambition of one day becoming fully fledged parental controls on Windows - which is sorely lacking competent solutions.

I built out a more robust AutoLogout client this year, with an _Out of the Box Experience_ (OOBE) and an installer, plus a QR code generator for setting up syncing with your phone. You can now install AutoLogout with a simple command in the terminal; `winget install Yiays.AutoLogout`

In addition, I built a solid API for storing and syncing bedtime and screentime rules alongside basic stats.

And finally, I built a simple Android app for connecting to the API and managing screen time for multiple Windows PCs remotely. You can find it on the Play Store [here](https://play.google.com/store/apps/details?id=com.yiays.autologoutmanager).

You can check out the website with further info and installation instructions [here](https://autologout.yiays.com/).

## Conclusion

I think the best outcome you can hope for when life starts to get in the way of your hobbies is that the quality of your work remains high while the quantity slumps. I would like to humbly claim that is true for my 2025 in programming.

Some major milestones were achieved this year, and I'm very happy with the quality of code I'm outputting with the help of some newly acquired skills.