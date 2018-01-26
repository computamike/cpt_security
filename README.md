# Custom Post Type Security

__UPDATE : This issue is now potentially resolved__
### When attempting to write the studies WordPress was performing a check against `current_user_can` for `edit_post`, and this was returning a false.  Even with `edit_post` capability set, it was failing to map this correctly.  Setting `'map_meta_cap' => true,` when registering the custom post type resolved this issue.

This project is a plugin which installs a custom post type - based on the tutorial [here](https://typerocket.com/ultimate-guide-to-custom-post-types-in-wordpress/).

## So what's going on?
~~After installing the plugin - a subscriber with what appears to be appropriate privilages is able to create a study post record, but unable to submit it for review.~~


## Steps to recreate the issue.
* ~~Install the plugin into a wordpress site.~~
* ~~As an administrator, the plugin grants all permissions to the administrator user.~~  
* ~~Administrator can create and publish studies.~~
* ~~Create a subscriber user~~
![Creating a simple subscriber](/resources/logged_in_as_subscriber.png)
* ~~Notice that the user has nothing - and can't add studies.~~
* ~~Install the [Capability Manager Enhanced](https://en-gb.wordpress.org/plugins/capability-manager-enhanced/) plugin~~
* ~~Switch oto the Administrator user, and load the Capability Manager Enhanced plugin~~
* ~~load the Subscriber role - it should look something like this :~~
![Initial subscriber settings](/resources/initial_subscriber_settings.png)
* ~~Now set the edit permission for the subscriber user - the subscriber can now edit studies.~~
![Initial subscriber settings](/resources/updated_subscriber_settings.png)
* ~~Switch to the subscriber user - note that the menu now shows a studies option~~
![Initial subscriber settings](/resources/subscriber_has_studies_option.png)
* ~~Subscriber can click on Studies option, and can see studies that have already been created~~
![Initial subscriber settings](/resources/subscriber_can_click_studies.png)
* ~~Subscriber can create a new study - a subscriber has no publish permission, so they can only submit for review.~~
![Initial subscriber settings](/resources/subscriber_can_create_study.png)
* ~~Clicking on the submit for review button presents the following screen.~~
![Initial subscriber settings](/resources/subscriber_cant_publish_for_review.png)
