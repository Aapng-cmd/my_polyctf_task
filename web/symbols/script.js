// fullPage.js controls
$(document).ready(function() {
  $('#fullpage').fullpage({
	  scrollOverflow: true,
		sectionsColor: ['black', '#0c0c0c'],
		afterLoad: function(index){
		  if(index === "secondPage") {
		    $(this).resize();
		  }
		}
  });
            
  $(".overlay, .popup").fadeToggle();
});

var cardsRiderWaite = [
  {
    name: "The Fool",
    fileName: "0.jpg",
    home: "XII",
    descr: "<p>Upright:<br>Free of burdens. Free of worries. Living in the now. Fearlessly taking risks, not of bravery but of naivete. A new start, and a blank page. An open mind, and an adventurous heart. The Fool is a child sampling life. Spontaneous. Endearing. Exploring where his whims take him. Anything is possible. But his little dog may be warning him not to step too close to the edge of the cliff. The Fool may be studying the stars when he should be looking where his next step will land. He may be a likely victim of trickery and deception. An easy target for bullying or usery. Traditionally, also a suggestion of careless and excessive sexuality. This card more than any other represents the subject, experiencing the influences of the diverse cast of characters in the Tarot deck.<br><br>Reversed:<br>Foremost, the victim of recklessness. Reversed, the Fool falls from the cliff. After his painful landing, he may shy away from risk taking, become suspicious or fearful. But, sometimes read as the exaggeration of the negative aspects of the upright position. Even greater excesses or irresponsibilty. Foolish choices. In some contexts, also seen as a call to accept responsibility and quit acting the Fool.</p>"
  },
  {
    name: "The Magician",
    fileName: "1.jpg",
    home: "I",
    descr: "<p>Upright:<br>Revelation. Positive transformation. Progress. Understanding that which is already known. Appreciating that which is already available. Clever. Focused. Diplomatic. Interesting. Note the symbol of infinity representing the heights of achievement possible. The Magician is the facilitator of the Tarot deck. Enabling the subject to utilize their talents and abilities to better advantage. A salesman who sells you on yourself. At his worst, a bit conniving and manipulative. In readings where the Magician represents the subject, heightened communications skills and persuasiveness are also suggested. When representing another, pay close attention. Remember that although the Magician is usually an agent of progress and growth, he is also capable of trickery and deception.<br><br>Reversed:<br>Low self esteem. Problems communicating. Options are lacking. Progress is difficult, and opportunities overlooked. Sometimes overconfidence or poor planning that obscure understanding. Inability to utilize the tools available. Reversed, the persuasive powers of the Magician may result in self deception. Traditionally, a con man, user, phony. Also, take care to protect against head injuries.</p>"
  },
  {
    name: "The High Priestess",
    fileName: "2.jpg",
    home: "I",
    descr: "<p>Upright:<br>Surprising and unexpected revelations may by coming. The High Priestess card represents illumination, knowledge and truth. She is eminently feminine, mysterious, secretive and intuitive. Moody and aloof. Knowing all, but expressing her secrets by measure, or through symbolism. Yet she is a powerful advisor. A well of knowledge, but only a cup at a time is dispensed. This card may often represent the subject, if female, or the object of the subject's desire, if male. Also, perhaps a suggestion for introspection or meditation. Traditionally, she represents knowledge, modesty and discretion.<br><br>Reversed:<br>Passion. Indiscretion. Immodesty. Promiscuity. Seduction. Betrayal. Revealing secrets to cause embarassment and hurt, rather than to share knowledge. Selfishness or shallowness. The High Priestess card reversed may also be a warning to pay heed to feminine health issues.</p>"
  },
  {
    name: "The Empress",
    fileName: "3.jpg",
    home: "II",
    descr: "<p>Upright:<br>Birth. Growth. Development. Nurturing. The Empress is a good mother. Fruitful, benevolent, loving and caring. A person of station deserving of respect. When seeking answers about one's self, the card may indicate motherly worries about people or projects. It may raise the question of too much mothering or overprotectiveness. It may also be a reminder to the seeker that patience and persistence are necessary when nurturing growth. Traditionally, fertility, wealth, marriage, a female family member.<br><br>Reversed:<br>The opposite of nurturing and caring. Disregard for others. Abandonment of those who need care. Perhaps an indication to learn to be a better nurturer or caretaker. Traditionally, infertility, poverty, lethargy, infidelity.</p>"
  },
  {
    name: "The Emperor",
    fileName: "4.jpg",
    home: "II",
    descr: "<p>Upright:<br>The Emperor represents power, stability and leadership. Fatherhood. A person to be counted upon, trusted and respected. The character and will to keep the ship on course. When seeking answers about one's self, the card might also indicate that introspection is suggested, and decisions may need to be made on whether the benefits of leadership are worth the sacrifices.<br><br>Reversed:<br>Reversed, the Emperor represents immature and controlling behavior. Demand for power, but lack of character. This may also negatively affect a family or organization who rely on the Emperor's leadership. If the Emperor is dethroned, the empire will be affected.</p>"
  },
  {
    name: "The Hierophant",
    fileName: "5.jpg",
    home: "III",
    descr: "<p>Upright:<br>Once known as The Pope. A teacher and a counselor. A good and benevolent influence. Helping the subject understand the correct path. A priest, rabbi, or perhaps a guru. One who enlightens. The Hierophant represents learning and living by the rules of society and of spirituality. But in some contexts, inflexible and unyielding. Unwilling to accept deviation from the conventional. Traditionally, merciful, forgiving, kind, respectable, dutiful. This card also represents joining and accepting. Sometimes interpreted to suggest marriage.<br><br>Reversed:<br>Rejection of traditional morals. A renegade. Anti-establishment. Breaking the rules. Conversely, the inverted card often is thought to represent excessive stubbornness, stodginess, inflexibility or conformity. My way or the highway. In certain contexts, could suggest divorce. Also, perhaps a warning of respiratory infections such as cold and flu.</p>"
  },
  {
    name: "The Lovers",
    fileName: "6.jpg",
    home: "III",
    descr: "<p>Upright:<br>Following the heart. Trust. Relationship. Responsibility. Commitment. Also partnership and cooperation. The Lovers may be an indicator of a love affair, but more so has to do with making good choices. Recognize the difference between love and infatuation.<br><br>Reversed:<br>Relationship problems. It could be Romeo and Juliet, passionate lovers kept apart by their feuding families. It could be discontent resulting from a poorly considered marriage. The unhappy consequences of bad choices. In some contexts the harbinger of breakups or divorce.</p>"
  },
  {
    name: "The Chariot",
    fileName: "7.jpg",
    home: "IV",
    descr: "<p>Upright:<br>Triumph. Mastery. But not easy and swift. Achieved through careful planning, hard work, force of will and foremost by harnessing disparate forces to work in unison. Self control, confidence, commitment, effort and focus that produce success. Overcoming obstacles. Also, often relates to travel. A trip or a move may be coming soon. Traditionally, journeys, exploration, conquest, control.<br><br>Reversed:<br>Difficulty or failure coordinating disparate forces. Lack of control. Lashing out. Rashness. Indecision. Moving in circles. Sometimes interpreted as a warning of stress related illness, such as ulcers. Also possibly vehicle or travel problems. Traditionally, accidents, defeats, delays.</p>"
  },
  {
    name: "Strength",
    fileName: "8.jpg",
    home: "V",
    descr: "<p>Upright:<br>Mastery, focused inward. Force of will. Self control. The courage, confidence and persistence to follow through to the successful conclusion, in spite of difficulties. Harnessing one's own talents and strengths. May represent providing a calming influence on others. Traditionally, fortitude, patience, perseverance, endurance. Sometimes, love of animals, particularly cats.<br><br>Reversed:<br>Not in control. Unable to harness inner forces. Extremes of anger or timidity. Avoidance. Cowardice. Unable to break bad habits or overcome addictions. Traditionally, anger, tyranny, weakness, cruelty, impatience. Sometimes a warning of health problems related to anger and agitation, such as high blood pressure.</p>"
  },
  {
    name: "The Hermit",
    fileName: "9.jpg",
    home: "VI",
    descr: "<p>Upright:<br>Introspection. Spirituality. Looking objectively at the world around. Learning for the sake of learning. Stepping back from the fast pace of life for a while to take stock of where you are. It may be time to consider the lessons of the past. Increasing knowledge for the sake of doing so. A need for space and time alone. Possibly a wise confidant or tutor. A beacon of knowledge. Traditionally, wisdom, reserve, meditation, secrecy.<br><br>Reversed:<br>Antisocial. Withdrawn. Senile. Lost in the dark. Possibly a victim of betrayal. Perhaps fears of growing old or being alone. This could be a warning to think more objectively. Also, beware of false or ignorant teachings. Traditionally, reclusiveness, isolation, lonliness. Be conscious of diseases related to aging, such as arthritis or hearing loss.</p>"
  },
  {
    name: "Wheel of Fortune",
    fileName: "10.jpg",
    home: "VI",
    descr: "<p>Upright:<br>Unexpected good luck. Raises. Promotions. Prosperity may be coming your way. Good news about health issues. As always, good luck becomes better for the prepared and the proactive, but this card also represents providence. Traditionally, fortune, good health, advancement.<br><br>Reversed:<br>Ups and downs. Instability. Unpredictability. Apparent good fortune may not turn out to be so good after all. After finally being promoted to the white collar job, white collar jobs are downsized. Traditionally, negligence, inconsistency, speculation, cruel fate. Possibly might suggest fluctuating health issues such as allergies or weight gain.</p>"
  },
  {
    name: "Justice",
    fileName: "11.jpg",
    home: "VII",
    descr: "<p>Upright:<br>Truth. Balance. Fairness. Equality. Doing the right thing, even if it is not the most desirable thing. The Justice card speaks not only of getting one’s just deserts, but also of acting in fair and just ways. Perhaps a past injustice will be corrected. Although this card sometimes can represent courts and the legal system, it is generally a lesson to be fair and honest with one’s self and with others. It could indeed indicate winning a court case, however. Justice also suggests that the seeker should pay attention to promises, debts and obligations. Traditionally, balance, harmony, equity, integrity, fairness.<br><br>Reversed:<br>Injustice. Imbalance. Unfairness. Inequality. Not looking at the situation objectively. Disregard for what is right. Failure to be honest with one’s self or with others. Unfair or excessive criticism. Possible legal problems. Inappropriate or overly severe application of the law. Traditionally, bigotry, intolerance, false accusations, abuse of the legal system.</p>"
  },
  {
    name: "The Hanged Man",
    fileName: "12.jpg",
    home: "VII",
    descr: "<p>Upright:<br>Greater understanding. Sacrifice. Humility. Introspection. Acceptance. Contemplation. The Hanged Man is about opening one’s mind and overcoming preconceptions and prejudices. A card of meditation and revelation. Also a card of faith and trust. Disengage and look at the big picture. Perhaps others may be right about some things. Perhaps what had seemed so important really isn’t when you stop to think about it. Traditionally, selflessness, wisdom, suspension, entrancement, devotion, submission, intuition, regeneration.<br><br>Reversed:<br>Pretty much the direct opposite. Stubborness. Refusal to see other points of view. Distrust. Narrow mindedness. Unwilling to sacrifice or compromise. Traditionally, selfishness, procrastination, irresponsibility, lack of faith.</p>"
  },
  {
    name: "Death",
    fileName: "13.jpg",
    home: "VIII",
    descr: "<p>Upright:<br>Transformation and Rebirth. A stern and unwavering messenger heralding change that is inevitable and is coming soon. Think not of this fearsome horseman as the executioner, think of him as the Ghost of Christmas Yet to Come. This is a card of new beginnings. An old building is demolished so that a new and better one may be constructed. So also, old habits and lifestyles will be abandoned for new and better ones. Discarding past encumberances will make room for a better future. The demolition of the old and the construction of the new will not be easy or painless, but ultimately will make things better. Traditionally, transformation, mortality, destruction, deterioration. Also, in certain contexts, the Death card may represent intense sexual experiences.<br><br>Reversed:<br>Something that should die but it won't. A cycle should end but is wrongly perpetuated. Resisting or delaying change. Inability to move on after a tragedy. There may be an upside to the reversed meaning, though. It might represent a \"Blast from the Past\", something that was lost but is once again found. In contexts where the card represents another, it typically symbolizes a threatening figure, but possibly with sexual implications. Perhaps a passionate but dangerous relationship. Sometimes a warning of sexually transmitted disease or nerve damage. Traditionally, stagnation, immobility, pessimism, destruction.</p>"
  },
  {
    name: "Temperance",
    fileName: "14.jpg",
    home: "VIII",
    descr: "<p>Upright:<br>Moderation. Balance. Harmony. Synergy. Merging apparently opposite elements to create a whole greater than the parts. Adapting to the environment. Promoting, managing or directing to create a single product from the efforts of many. When interpreting a Tarot spread, Temperance is often significant relative to the cards around it. Perhaps apparently unrelated influences can be made to work in unison. Traditionally, moderation, adaptability, economy, unity, discretion, management, accomodation, and of course, temperance.<br><br>Reversed:<br>Pretty much the direct opposite of upright. Out of balance. Disharmony. The attempt to merge opposite elements fails. Individuals you are working with may be uncooperative. When focusing on health issues, Temperance reversed warns of possible serious illnesses such as food poisoning or infectious diseases made worse by stress or an out of balance metabolism. Traditionally, discord, bad combinations, lack of cooperation, conflict, competition, serious illness. Sometimes suggests religion and the church.</p>"
  },
  {
    name: "The Devil",
    fileName: "15.jpg",
    home: "IX",
    descr: "<p>Upright:<br>Excesses and extremes. Careless and unrestrained sexuality. Drug abuse. Alcoholism. Obsession. Perversion. Giving in to temptations. Exploring one’s deepest fantasies and desires. The Devil helps us unleash the repressed animal instincts we all have inside. Look closely at the card... This Devil is not Satan, this is Pan, the Greek Goat God of Pastures and Shepards, known for his extreme appetites. And also look at the chains around the necks of his \"captives\". The chains are so loose they could easily remove them. It is not by force the Devil holds them, it is by their own choice. He does not want to steal their souls, he wants to teach them to explore their inner selves. They could remove the chains and walk away at any time, but they choose to remain on the Devil’s leash. This card not only represents extremes of hedonism, addiction and self indulgence, but in some cases the opposite extremes of repression and abstinence. It is really a lesson on balance, teaching that extreme behaviour impedes achievement, progress and growth. When representing a person in a reading, the Devil is someone powerful and persuasive, likely a controller or manipulator, but also perhaps a teacher. Traditionally, violence, disease, force, drunkeness, passion, bondage, self destruction. When looking at one’s physical well being, be alert for physical or emotional abuse, addiction, or sexually transmitted diseases.<br><br>Reversed:<br>Most often, escape from the bondage of self destructive behavior. The subject is likely to realize the damage they are doing, and start down a more constructive path. Traditionally, liberation, recovery, understanding, virtue. In a few cases, though, the Devil reversed can represent succumbing totally to obsession or addiction, which explains the darker traditional meanings of pettiness, lust, bondage and bewitchment. In health matters, the Devil reversed suggests recovery from illness .</p>"
  },
  {
    name: "The Tower",
    fileName: "16.jpg",
    home: "X",
    descr: "<p>Upright:<br>The Tower is probably the most feared card in the Tarot deck. Unexpected catastrophe. Turmoil. Upheaval. It seems likely that the authors meant to warn of consequences for the hedonism described in the Devil card. You are sitting snug and happy in your castle tower, seemingly safe from the dangers below. Suddenly, a bolt from the blue smashes into your life, casting you out of your secure world. The image on this card is quite clear. Complacency is shattered. Stability is gone. Comfort and confidence are distant memories. But in some ways this card is not entirely different from Death. It also represents new beginnings, not by choice but by necessity. The Tower card brings us back down to earth. In a few situations, it is also suggested that this lightning bolt could represent the electricity of irresistible passion or true love striking the seeker. Traditionally, calamity, catastrophe, ruin, cataclysm, punishment.<br><br>Reversed:<br>Not much better than upright. Neville Chamberlain played out the Tower reversal when he acquiesced to Adolph Hitler occupying Czechoslovakia in exchange for \"Peace in Our Time\". Illusions of solving the problem without really doing it. Perhaps a temporary truce, but the war goes on. You may think you have smoothed things over, but catastrophe and turmoil are waiting for you around the corner because you have not really addressed the underlying problems. Traditionally, disruption, oppression, subjugation, persecution.</p>"
  },
  {
    name: "The Star",
    fileName: "17.jpg",
    home: "XI",
    descr: "<p>Upright:<br>The Star represents hope for the future. The water is being poured from the jugs to replenish the land and sea. Rejunvenation will come, although perhaps not just yet. Though doors have closed, windows will surely open as time passes. Traditionally, hope, inspiration, faith, promise.<br><br>Reversed:<br>A lack of hope, at least for the present. Opportunities are absent, and troubles persist. Traditionally, disappointment, instability, poor choices.</p>"
  },
  {
    name: "The Moon",
    fileName: "18.jpg",
    home: "XI",
    descr: "<p>Upright:<br>Mystery. Nightmares. Dreams. The fears that grow in the dark. Secrets. The Moon lights the gateway between the physical and metaphysical, the conscious and subconscious realms. Entering the Moon’s world is frightening, but can also be revealing and inspirational. The Moon suggests creativity and intuition. Possibly psychic revelations. Utilize the inspiration. Perhaps write or paint. But also respect the dangers lurking in the dark. Beware of deceptions and phony people. The subject must be very careful to avoid hiding their fears behind alchohol or drugs, as the Moon indicates increased vulnerability to these self destructive behaviors. Traditionally, hidden enemies, deception, illusion, danger, terror, lunacy, plots, dreams.<br><br>Reversed:<br>The upright Moon is not a comfortable card, but the reversal in ways is more frightening. Although it indicates less danger of external hidden enemies and deceptions, it suggests heightened fears or denials. Perhaps overly emotional or delusional behavior. Irrational and intense fear could cause psychological problems. The wildness and chaos of the dark may be getting out of control. This is also a card of travel, in a different sort of way. It is said to sometimes portend Astral Travel, the experience of consciousness traveling outside of the body. When looking at health issues, the Moon represents sleep disorders, mental illnesses, drug overdoses and coma. Traditionally, inconsistency, instability, fantasy, ambush, fraud, usery.</p>"
  },
  {
    name: "The Sun",
    fileName: "19.jpg",
    home: "XII",
    descr: "<p>Upright:<br>The Sun is a happy card. Bright children enjoying a beautiful new dawn. Emergence from the darkness of the night into the light of the day. Radiance. Energy. Success. Prosperity. Clarity of thought, enhanced by previous trials, but also fueled by youthful optimism. Pessimism is overcome. Depression fades. New ideas. Creativity. Enthusiasm merges with experience. Sometimes suggests a marriage or childbirth. Traditionally, revelation, enlightenment, success.<br><br>Reversed:<br>Not entirely the opposite, but something obscures the clarity of the upright aspect. Refusal to open ones eyes to the possibities. Most likely this will be a temporary delay. The enthusisasm and abilities are there, but the focus is clouded. Ultimately, the clouds should clear up. Traditionally, lesser happiness, passion, pride, misunderstanding. The prize is right there, but to attain it, cynicism must be overcome.</p>"
  },
  {
    name: "Judgement",
    fileName: "20.jpg",
    home: "XII",
    descr: "<p>Upright:<br>Resurrection. Accepting the past and throwing off it's burdens. Forgiveness, especially of one's self, but also of others. Major decisions which may result in major lifestyle changes. Traditionally, renewal, awakenings, repentance, change.<br><br>Reversed:<br>Inability to change or progress. Troubled or affected by the past. Perhaps held back by others. Possibly unable to move forward as a consequence of past deeds. When looking at health issues, Judgement may suggest allergies and discomfort from allergic reactions. Traditionally, delay, stagnation, postponment, indecision.</p>"
  },
  {
    name: "The World",
    fileName: "21.jpg",
    home: "I",
    descr: "<p>Upright:<br>Realization. Attainment of major goals. Reward. Recogniton. Triumph. The World card speaks of understanding the big picture. Everything falls into place. The end of the Fool’s Journey, but the beginning of other journeys. Now it is time that all the knowledge and experience can be used to do great things. A card of travel. Perhaps you are a diplomat on a mission to negotiate treaties, or a business leader opening new markets. The World indicates understanding, success and achievement. Traditionally, completion, fulfillment, perfection, promotion, honors, good health. A good omen for successful childbirth.<br><br>Reversed:<br>Not an opposite meaning so much as a delay. The tools seem to be there, but the successful completion is as of yet unattained. Perhaps fear of what lies beyond is preventing completion. Sometimes thought to represent hollow or half hearted efforts. A person with great credentials resting on their laurels. Travel may be delayed or interrupted. Combined with the wrong cards in a reading, The World reversed could represent failure or serious problems. In health matters, The World generally represents good health and successful childbirth, unless negatively influenced by other cards in a reading, in which case it can suggest skeletal or orthopedic problems. Traditionally, inertia, stagnation, obstacles, failure, imperfection.</p>"
  },
  {
    name: "Ace of Wands",
    fileName: "22.jpg",
    home: "I",
    descr: "<p>Upright:<br>New beginnings, new thinking, new opportunities. New friends and co-workers. The excitement of starting new projects or new jobs. As the Aces represent beginnings, and the Wands represent inspiration and mental energy, this card in particular represents new ideas and plans. Traditionally, creation, invention, energy, birth, adventure.<br><br>Reversed:<br>Postponements, deferrals, cancellations. Difficulties getting started. Loss of work or social contacts. Perhaps the time is not right to start that new project. Lack of energy. Traditionally, decadence, perdition, fall, clouded joy, abandonment, possibly a difficult childbirth.</p>"
  },
  {
    name: "Two of Wands",
    fileName: "23.jpg",
    home: "II",
    descr: "<p>Upright:<br>Choosing well and following the chosen path. Though hard work will always be necessary, achievement of success is likely.<br><br>Reversed:<br>Unable to choose the best path. Indecision and uncertainty. As a result, success may not come anytime soon.</p>"
  },
  {
    name: "Three of Wands",
    fileName: "24.jpg",
    home: "III",
    descr: "<p>Upright:<br>Strength, boldness, effort, commerce, discovery. The ideas and energy of the Wands are taking tangible form. The wheels of enterprise are in motion. The entrepreneur watches his ships full of merchandise sail off on what he hopes will be a successful voyage. Travel may be required to bring the operation to fruition. Traditionally, trade, negotiations, enterprise, travel, audaciousness. Cooperation in business.<br><br>Reversed:<br>Delays or interruptions. Problems making the plans work. Difficulties with the voyage. Lack of cooperation from others. Expected rewards may not be forthcoming, or may require exceptional efforts. Traditional meanings include distrust, misfortune and treachery, but also the end of trouble and toil. Be on guard for partners with ulterior motives.</p>"
  },
  {
    name: "Four of Wands",
    fileName: "25.jpg",
    home: "IV",
    descr: "<p>Upright:<br>Success. Rewards for one’s hard work. A good harvest after a long season of caring for the crops. Celebrations. Fairs. Harvest festivals. Time to relax and enjoy the company of friends and loved ones. And also to give thanks. There may be partnerships in formation, business or personal. Sometimes thought to suggest martimony. A good first step toward a prosperous life. Traditionally, community, reunion, gatherings, relaxation, prosperity.<br><br>Reversed:<br>Not very different from the upright aspect. The foundation for success has been laid, and it is time to celebrate that achievement. But something may be missing. Perhaps the subject does not quite appreciate what they have achieved, or the blessings they have been given. Perhaps they are not quite yet ready for partnership or marriage. Perhaps they are a bit insecure and don’t fully recognize their own abilities. Traditionally, pleasure, advancement, beauty, but the pleasure is hollow and the beauty is tarnished. This card is known as a good omen for recovery from illness and for healthy childbirth.</p>"
  },
  {
    name: "Five of Wands",
    fileName: "26.jpg",
    home: "V",
    descr: "<p>Upright:<br>Competition. Contests. Contention. Struggle. Others will not just stand aside. The lesson of the Five of Wands is that it is necessary to deal with competitors to achieve success. Walking away from the contest will result in loss. Learn to work with the opposition for mutual benefit, or strive to rise to the top. Be open to the ideas of others, but also alert to their self interests. Also, maintain self-control and avoid anger. The traditional meanings suggest victory in this struggle: gain, riches, abundance, happy marriage.<br><br>Reversed:<br>Walking away from opportunity to avoid the struggle. Fear of competition. Alternatively, litigation, dispute and trickery by the opposition are likely if the contest continues. Traditionally, lawsuits, fraud, persecution, harassment, delays. But a favorable outcome is suggested if one stays in the game.</p>"
  },
  {
    name: "Six of Wands",
    fileName: "27.jpg",
    home: "VI",
    descr: "<p>Upright:<br>Known as the Victory Card, the Six of Wands celebrates overcoming previous challenges, and also suggests that future victories are coming soon. Study the card and note that the horseman is surrounded by his troops. This is not only a card of personal victory, it is a card of team victory. The leader has achieved his success with the help of his followers, and without teamwork, it would not have been possible. Traditionally, good news, hope, desires, expectations, fulfillment.<br><br>Reversed:<br>The opposite. Victory is not forthcoming. Likely due to dissension or disloyalty on the team. Problems working together with subordinates. Distrust. Disharmony. Betrayal. The leader perhaps makes his followers feel that he thinks he is above them, causing resentment. A warning to appreciate the efforts of those working with you, and find to a way to let them know that you do. Traditionally, infidelity, disloyalty, betrayals, overconfidence.</p>"
  },
  {
    name: "Seven of Wands",
    fileName: "28.jpg",
    home: "VII",
    descr: "<p>Upright:<br>After achieving success, it will be necessary to fight to stay on top. There is no room for complacency, but there is need for perseverance. The subject’s dominating position helps assure their ultimate victory, but only if they continue to make their best efforts. The Seven of Wands speaks particularly of the business world, but might also have implications for sport or other competitive endeavors. Traditionally, commerce, conferences, gossip, profit, advantage, competition.<br><br>Reversed:<br>Defensiveness. Withdrawal into fortifications. Fearful or lacking the energy to continue the competition. Possibly losing composure or poise in the face of contention. Traditionally, indecision, embarrassment, doubt, anxiety.</p>"
  },
  {
    name: "Eight of Wands",
    fileName: "29.jpg",
    home: "VIII",
    descr: "<p>Upright:<br>Acceleration. Enthusiasm. The pace of life quickens. The Eight of Wands card has been described as Arrows of Love and Falling in Love. Perhaps the subject is, or soon will be, in a new, exciting relationship. Perhaps new business ideas are fueling excitement and productivity. High speed travel is possible, perhaps a journey by air. In any case, utilize the energy and enjoy the ride, but avoid carelessness. Traditionally, activity, swiftness, haste, great hope, progress, direction, new love.<br><br>Reversed:<br>Arrows of Love become arrows of jealousy. Arguments, disharmony. Delays. Setbacks. Things may be stalled, or alternatively, the frantic pace was too much and mistakes resulted. The new ideas may not have been so good after all. Traditionally, Internal dispute. The sting of conscience. Quarrels, discord, regret. Be wary of meddlers or outsiders that may cause marital strife.</p>"
  },
  {
    name: "Nine of Wands",
    fileName: "30.jpg",
    home: "IX",
    descr: "<p>Upright:<br>Anticipation. Suspension. Possibly hidden enemies. This warrior has come a long way, overcoming many challenges. He is on the verge of completing his quest. But he knows he must pause, perhaps from exhaustion, perhaps to protect himself from danger. He has the tools and the skills to defend himself, if necessary. The real danger that he faces is accepting less than he has earned. The Nine of Wands teaches us that we must see the quest through to it’s conclusion. Analyze the situation. Get some rest if possible. Prepare defenses and consolidate the position, if necessary. But don’t end the quest. When rested and prepared, finish what has been started. Traditionally, delay, estrangement, adjournment, prudence, experience.<br><br>Reversed:<br>The position may be indefensible. The warrior may be too tired to continue. Perhaps the necessary will or energy is lacking. Surrender or abandonment may be the only apparent options. It might be time to find help, or if none is forthcoming, withdraw from the engagement as prudently as possible. When looking at health issues, the Nine of Wands could suggest mild but chronic illness that saps energy. Traditionally, obstacles, adversity, calamity, barriers, sluggishness.</p>"
  },
  {
    name: "Ten of Wands",
    fileName: "31.jpg",
    home: "X",
    descr: "<p>Upright:<br>The burden may be too great. Atlas holding the world on his shoulders. Great achievements have been made, but the job is not getting any easier and weariness may be setting in. Perhaps it is time to take a breather for a while. But don’t give up. Persistence and determination will bring success. Traditionally, betrayal, oppression, gain, fortune.<br><br>Reversed:<br>The opposite of working too hard. Irresponsibility. Broken promises. Lack of dedication. Traditionally, treachery, intrigue, difficulty, unexpected problems.</p>"
  },
  {
    name: "Page of Wands",
    fileName: "32.jpg",
    home: "I",
    descr: "<p>Upright:<br>A message. News of the new and exciting. The Page of Wands, also known as the Princess of Wands, suggests enthusiasm and zeal. When representing a person, this card likely means a youth with vigor and ambition, working hard to achieve a goal. It also speaks of excitement and dedication for projects or hobbies. Traditionally, surprising, exciting, consistent, faithful and helpful.<br><br>Reversed:<br>Pretty much the opposite of the upright aspect. Bad news. Lack of interest or rejection of new projects. Unwilling to help others. Prone to tantrums and rashness. Delinquency. Traditionally, unstable, inconsistent, unfaithful.</p>"
  },
  {
    name: "Knight of Wands",
    fileName: "33.jpg",
    home: "V",
    descr: "<p>Upright:<br>Bold, passionate, exciting, spontaneous. The Knight, or Prince, of Wands is a fiery force in relationships. He begins new projects with excitement and creativity. But follow-through is his shortcoming. He is easily bored and prone to move on before things are finished. Although a loyal friend, he is not inclined to relinquish the variety and excitement he craves for a permanent engagement. As with all the Knights, a symbol of travel, suggesting long trips overland by highway. Traditionally, flight, separation, distance, abandonment, emigration.<br><br>Reversed:<br>The reversed Knight of Wands is not outwardly so different from the upright. But he is of lower character, at least for the present. Still bold and spontaneous, but more prone to bully or abuse. Egotistical, impatient, thoughtless and uncaring. Perhaps he might pursue a woman he isn’t really interested in for the amusement of conquering her or breaking up a relationship. Traditionally, estrangement, division, rupture, strife. Possibly car problems or other negative issues affecting travel. Whether upright or reversed, the Knight of Wands suggests departure. Enjoy the glow while you can, he may not be around very long.</p>"
  },
  {
    name: "Queen of Wands",
    fileName: "34.jpg",
    home: "IX",
    descr: "<p>Upright:<br>Creative. Passionate. Bold. Confident. Determined and energetic, but charming. A natural leader. The Queen of Wands’ characteristics often lead to the performing arts. She could be the entertainment director on a cruise ship, perhaps a movie star or an advertising executive. Independent and courageous, she is likely to firmly reject any efforts to rein her in, as her black cat warns. But she is also a loving, loyal mother and partner. Her passion for achievement may sometimes lead her to become a bit more involved in her children’s affairs than she needs to be. Traditionally, friendly, honorable, charming, understanding, a lover of money who is likely to succeed in business.<br><br>Reversed:<br>Spitefulness. Intolerance. The reversed Queen of Wands presents a couple of possibilities. Most commonly, her fire and boldness are exaggerated, while her compassion and loyalty are diminished. This queen may be impatient, jealous, cruel and vengeful. She may be short tempered and think nothing of using her substantial resources to exact unjustly severe revenge for some minor slight. If she is angry at her partner, she may punish him with infidelity. In some cases, however, her energy may simply be drained and she could become withdrawn and unable to sustain her usual workload. Traditionally, the meanings are dependent on the card’s position in the layout, and swing from obliging and economical to deceit, jealousy and infidelity.</p>"
  },
  {
    name: "King of Wands",
    fileName: "35.jpg",
    home: "I",
    descr: "<p>Upright:<br>The Kingdom of Wands symbolizes energy, inspiration and desire. The King of Wands is a natural leader who has no doubt that he is in charge. Courageous, charismatic, generous. His ambition drives him ever onward toward greater achievements. His confidence, energy and enthusiasm infect those around him. He greatly enjoys social events and is a loyal friend. As a parent, he is more likely to lead his children by influence and inspiration than with discipline. He enjoys starting new projects, but does not always finish up. Traditionally, honesty, integrity, talent, genius.<br><br>Reversed:<br>The reversed King of Wands can be intolerant, impatient, overbearing and domineering. He may be childish, selfish, short tempered or jealous. He might lash out at those he believes are not paying him enough respect. Another facet of this reversal may be the King’s abdication. Perhaps the responsibilities of leadership are more than he can handle. If looking at health related issues, pay attention to circulatory problems and be cautious to avoid head injuries. Traditionally, excess, exaggeration, severity.</p>"
  },
  {
    name: "Ace of Swords",
    fileName: "36.jpg",
    home: "I",
    descr: "<p>Upright:<br>A sharper mind. A clearer focus. A new birth of energy. Developing and following through on new projects. There may be some questions or uncertainties, but the energy of the sword will cut through the red tape. This card is sometimes thought to suggest surgery, and often thought to represent \"the pen\". Therefore it is a particularly good omen for new projects involving writing. Though the card represents ambition and determination, it is also a card of fairness and justice.<br><br>Reversed:<br>Pretty much the direct opposite of the upright aspect. A bad omen for new projects. A lack of ambition. Difficulty focusing thoughts or making plans. A warning to avoid taking on too much. As this card often represents writing, reversed it may represent writer's block, or lack of creativity. The need for compromise is indicated.</p>"
  },
  {
    name: "Two of Swords",
    fileName: "37.jpg",
    home: "II",
    descr: "<p>Upright:<br>Foremost, a suggestion that the subject is the agent of compromise. A diplomat keeping the peace. However, remaining neutral causes internal conflict and doubt. Difficulty in making decisions may result. It may prove valuable to join forces with a like minded person. Keeping the peace will be a short term task, and will lead to personal growth.<br><br>Reversed:<br>Lack of compromise. Breaking the peace. Taking sides. Perhaps even fueling the hostilities. Treachery, lies or phony people may also be suggested.</p>"
  },
  {
    name: "Three of Swords",
    fileName: "38.jpg",
    home: "III",
    descr: "<p>Upright:<br>Swords through the heart, just as it appears. Heartache. Hurt feelings. Cruel and cutting words. Pent up anger or resentment, released perhaps in the waning moments of an unhappy relationship. Looking at health related issues, the Three of Swords suggests that surgery might be necessary. Traditionally, removal, absence, delay, division, separation, hatred, incompatibility.<br><br>Reversed:<br>Where the upright Three of Swords suggests conclusion and clearing the air, however hurtful that might be, reversed this card implies lingering pain and frustrations. Perhaps the subject’s partner is blatantly unfaithful but they continue the unhappy relationship. Perhaps the person in question cannot overcome past trauma and continually dwells on it. A warning that this emotional torture must be confronted at some point, or it will only grow more severe. Traditionally, alienation, loneliness, insanity, confusion, disorder.</p>"
  },
  {
    name: "Four of Swords",
    fileName: "39.jpg",
    home: "IV",
    descr: "<p>Upright:<br>Tranquility. Introspection. Meditation. Prayer. Resting. Healing. Temporary withdrawl from stress and strain. Traditionally, solitude, exile, retreat, banishment.<br><br>Reversed:<br>Awakening. Recovery, perhaps from illness or possibly from emotional trauma. The painful lessons learned will not be lost. Greater caution will be exercised in the future. The time for resting has passed, or perhaps rest is not possible at this time. Traditionally, circumspection, economy, cautiousness, foresight, sympathy.</p>"
  },
  {
    name: "Five of Swords",
    fileName: "40.jpg",
    home: "V",
    descr: "<p>Upright:<br>Dynamism and determination overwhelm kindheartedness. The victor believes he is right and honorable, but has little compassion or empathy. Victory at what cost? Are those former friends walking away beaten and intimidated? Short term victory that may result in long term loss. Depending on the context, possibly an indicator of abuse. A lesson that you can never win with some people, and sometimes you just have to walk away.<br><br>Reversed:<br>The reversal of this card does not really result in a reversal of the meaning. The outcome may be the same, or perhaps result in a deadlock. If victory is won, it may be a hollow victory haunted by regret. And similar battles are likely to continue. Making peace is the best alternative. Also, traditionally read as a bad omen for a new partnership or enterprise.</p>"
  },
  {
    name: "Six of Swords",
    fileName: "41.jpg",
    home: "VI",
    descr: "<p>Upright:<br>Journeys by water. Perhaps for pleasure, but more likely the Six of Swords metaphorically suggests traveling away from previous confrontation and turmoil. The journey will take the subject to a place of greater harmony on the far shore. What is left behind is also significant... this card suggests moving on from naive or erroneous ideas toward a state of clearer understanding, improved communications and greater knowledge. Traditionally, expedience, passage, travel, voyage.<br><br>Reversed:<br>Unwilling or unable to leave the current situation behind. Feeling trapped or perhaps fearful of the journey. Communication problems. Misperceptions. Travel may be delayed or interrupted. Also, a warning of possible danger from water. Be wary of storms, flooding, children around swimming pools and other water hazards. Traditionally, confessions, disclosures, publicity, unwanted marriage proposals or declarations of love.</p>"
  },
  {
    name: "Seven of Swords",
    fileName: "42.jpg",
    home: "VII",
    descr: "<p>Upright:<br>Gaining advantage by stealth. Taking calculated risks. Possibly spying or deceptiveness for strategic reasons. Sometimes an elopement is suggested. Often interpreted as a forthcoming journey overland, which may be made in secret. Also could suggest a clandestine affair.<br><br>Reversed:<br>Lack of confidence or perhaps guilt prevent risk taking. Possibly taking stock of previous actions and working to right past wrongs. Working for forgiveness. Also a warning to be wary of others secretly working to gain advantages.</p>"
  },
  {
    name: "Eight of Swords",
    fileName: "43.jpg",
    home: "VIII",
    descr: "<p>Upright:<br>Trapped. In bondage. Imprisoned in a cage of swords. The blindfold makes finding the way out difficult. But these swords and this blindfold are usually metaphorical. The blindfold may be self imposed. It may be fear or insecurity that is keeping the subject locked up in an unpleasant place. They may be overwhelmed with worries that prevent them from seeing the situation clearly. With boldness and courage, escape is possible. Depending on the question and the influences of the surrounding cards, however, the Eight of Swords in some cases may actually represent legal judgments resulting in imprisonment or injuries resulting in hospitalization. Traditionally, accident, calamity, bad news, violence, crisis, censure, conflict, illness.<br><br>Reversed:<br>Unfortunately, not a complete opposite. While small successes through hard work are suggested, it will require persistence and ingenuity to break free, and there will be ups and downs along the way. Traditionally, opposition, misfortune, danger, difficulty, overcoming past treachery.</p>"
  },
  {
    name: "Nine of Swords",
    fileName: "44.jpg",
    home: "IX",
    descr: "<p>Upright:<br>Isolation. Depression. Negativity. Desperate sorrow. Bad dreams or trouble sleeping. Overwhelmed by worries. Though the problems are serious, it may be time to start looking for solutions rather than focusing on past events. Traditionally, delay, disappointment, despair. In some contexts this card is thought to suggest the possibility of miscarriage or death.<br><br>Reversed:<br>The struggle to overcome depression and pessimism. The flame of recovery could be starting to flicker. It may not be easy, but this reversal might signify the first and most difficult steps have been taken. Traditionally, struggle, doubt, shame, rumors, defiance.</p>"
  },
  {
    name: "Ten of Swords",
    fileName: "45.jpg",
    home: "X",
    descr: "<p>Upright:<br>A card of endings. Hopes dashed. A battle lost. Things are as bad as they can get. Not particularly a warning of physical injury, though. Betrayal, false friends, or a need to be alert for enemies may be suggested. Most likely, it is time to end this struggle, take stock and move on to new things.<br><br>Reversed:<br>Since things can't get any worse, they are going to get better. Windfall profits or unexpected kindnesses may be received. However, gains and successes may be temporary. In reverse, this card means not entirely the oppposite of it's upright aspect. It may be a warning of ups and downs along the way for a time.</p>"
  },
  {
    name: "Page of Swords",
    fileName: "46.jpg",
    home: "III",
    descr: "<p>Upright:<br>Alertness. Readiness. Espionage or surveillance. Studying the situation. Possibly defensiveness. Awaiting something with expectation. Often this card foretells the coming of an important message regarding a difficult or complex issue. Perhaps the message contains the solution. In the upright, the news is often good. Also, note the sword carried by the Page. Caution with sharp objects such as scissors or knives is suggested.<br><br>Reversed:<br>Reversed, the Page is not someone to confide in. Often a liar or a gossip. Transitory communication problems are suggested. Errors in written documents, hesitation or difficulty speaking may occur. It may also represent someone who has been mistreated as a child and feels beaten down and insecure. Nevertheless, the Page reversed can be spiteful and cutting. This aspect also represents important news, but in this case it is less likely to be good.</p>"
  },
  {
    name: "Knight of Swords",
    fileName: "47.jpg",
    home: "VII",
    descr: "<p>Upright:<br>Determination, will, perhaps anger. Leading a life and death charge into harms way. This Knight believes he is right. He is not prepared to accept less than victory. Although he is equipped with outstanding intelligence and wit, he must be on guard against impetuousness and impatience, which are his weaknesses. He craves action, and may be prone to start fights for the excitement of it. He is brave, but he can also be a bully. At his best, he may be the hero of the battle. At his worst, he may be the cause of the war. Upright, this warrior is hard to stop and is likely to win the victory.<br><br>Reversed:<br>When reversed, the Knight of Swords still strives for victory. But in this aspect, a dark side presents itself. Bravery may replaced by treachery, intelligence supplanted by cunning. The reversed knight may connive and backstab to have his way, or his revenge. The reversal could also indicate fatigue or futility, a letdown following his explosive charge. Depending on the context of the reading, this card reversed may also be interpreted as impending troubles with air travel.</p>"
  },
  {
    name: "Queen of Swords",
    fileName: "48.jpg",
    home: "VII",
    descr: "<p>Upright:<br>A woman who has been tempered by loss and sorrow. A strong, honorable, independent person. Demanding of herself, she is intolerant of others who are less demanding of themselves. Meeting her expectations may be difficult. Highly intelligent, she generously shares her knowledge. A great communicator of logic and fact. Behind her cold exterior, her intentions are good. But she can be hard to get close to. Traditionally, sadness, separation, widowhood.<br><br>Reversed:<br>The reversed Queen of Swords is not altogether the opposite, but her sorrows and disappointments may have left her bitter. Her intentions may not be so honorable as when upright. She might take solace in watching others endure sorrow. Her exceptional communication skills could be used to hurt others. Paradoxically, the reversed Queen could also suffer from problems communicating. When looking at health issues, respiratory problems due to allergy or pollution are possible. Traditionally, spitefulness, wickedness, maliciousness, deceit, vengeance.</p>"
  },
  {
    name: "King of Swords",
    fileName: "49.jpg",
    home: "XI",
    descr: "<p>Upright:<br>The Kingdom of Swords embodies character, principles, intellect and communication. Honest, strict, intelligent, the King of Swords is fair and balanced, but unyielding. When representing a person, he might be a judge, military officer, police officer or physician. Someone of high ethics who backs his words with actions. This card may suggest critical analysis of literary or legal documents, or technical writing. Traditionally, judgment, command, authority, law, militarism, power.<br><br>Reversed:<br>The reversed King of Swords may take strictness to the extreme. He may be unsympathetic, uncaring, heartless. Excessively harsh penalties could be based on anger or vindictiveness. Possibly blind conservatism that blocks progress. In some cases, this curmudgeonly behavior might be a result of oncoming senility. Uncertainty or inability to make decisions could also be suggested. Traditionally, cruelty, perversity, inhumanity, barbarity, evil intentions.</p>"
  },
  {
    name: "Ace of Pentacles",
    fileName: "50.jpg",
    home: "I",
    descr: "<p>Upright:<br>The seed of success. Opportunities are available. A better job. A promotion. Perhaps a windfall profit or an inheritance is on the way. With increased prosperity will come increased responsibility. A card of good fortune, but remember that the seed requires cultivation to bear fruit.<br><br>Reversed:<br>There may also be treasure in the reversal, but in this case it is more likely to be buried than shared. Greed. Selfishness. Holding on tightly to riches. Possibly so enchanted by the pot of gold that it is only clutched more tightly as the palace around it deteriorates into disrepair from negligence. Fortune that does not bring happiness. Alternatively, the opportunity does not come. Anticipated prosperity is not attained.</p>"
  },
  {
    name: "Two of Pentacles",
    fileName: "51.jpg",
    home: "II",
    descr: "<p>Upright:<br>Juggling, just like it looks. Keeping things in balance. Look past the juggler to the ships out at sea. He is working hard to keep things going until his ship comes in. He may need to spend some time with his partner or his family, to try and balance his life a bit better. His ship is in rough seas, but things will work out well for him if he doesn’t drop the ball. Traditionally, obstacles, agitation, trouble.<br><br>Reversed:<br>The conflicting demands are too intense. He cannot maintain balance any longer. He drops the Pentacle. He may try to cover up the problem with false gaiety. This aspect may also suggest that the subject’s work involves the written word, perhaps advertising or journalism. Traditionally, writing, letters, paperwork, messages, financial problems, false gaiety.</p>"
  },
  {
    name: "Three of Pentacles",
    fileName: "52.jpg",
    home: "III",
    descr: "<p>Upright:<br>Craftsmanship. Profitability. Recognition. Partnership. Good planning. Advancement through skill and effort. Working well with others to achieve success. The Pentacles represent down to Earth matters of business, employment and finance. This card signifies rising to a higher level in the material world. Passage from apprentice to journeyman. Traditionally, nobility, renown, glory, distinction.<br><br>Reversed:<br>The opposite. The result is unsatisfactory. Perhaps the subject’s efforts are ignored or unappreciated by superiors or customers. Perhaps their work needs improvement. Perhaps the problems are due to poor performance by co-workers or partners, but the result is the same. Traditionally, mediocrity, weakness, pettiness, laziness, waste.</p>"
  },
  {
    name: "Four of Pentacles",
    fileName: "53.jpg",
    home: "IV",
    descr: "<p>Upright:<br>Focused on money, business interests and material possessions. Developing structure to secure and perpetuate wealth or power. The Four of Pentacles is known as the Miser Card. This greed is driven by fear of losing what has been gained through previous labors. It may be time to relax a bit and perhaps share just a little of the wealth. Traditionally, surety of possessions, inheritance, investments, success in business.<br><br>Reversed:<br>Financial instability. Unable to hold on to money. Poor investment choices. Gambling. Wasteful spending. Previous gains are diminished or wasted. The stress of maintaining things may be too great. Perhaps a deliberate choice is made not to be a miser. Traditionally, hinderance, loss, suspense, delay, opposition.</p>"
  },
  {
    name: "Five of Pentacles",
    fileName: "54.jpg",
    home: "V",
    descr: "<p>Upright:<br>Financial problems. Job loss. Poverty. Hardships related to money. Frustrating and difficult, but not permanent. Lessons that the road is not always smooth. Traditionally, the Five of Pentacles also suggests loyal partners supporting each other through these difficulties.<br><br>Reversed:<br>A turnaround. After hard work and thought, the light at the end of the tunnel is getting brighter. Perhaps unexpected good fortune. Reversal of negative trends. The traditional interpretations of this aspect are darker, however. Traditional meanings include confusion, anarchy and discord. Possibly those who stood by each other during the lean times may be less faithful when the material situation improves.</p>"
  },
  {
    name: "Six of Pentacles",
    fileName: "55.jpg",
    home: "VI",
    descr: "<p>Upright:<br>Benevolence. Generosity. Charity. Sharing. Exchanges of money for admiration. Exchanges of energy to achieve balance. The Six of Pentacles may be about helping others, but it may also be about receiving help. You might be the benefactor, but you might also be the recipient. Perhaps the subject is freeing themselves from the burden of debt, financial or otherwise. Perhaps they may receive presents, bonuses or inheritances in the near future. If offered gifts, accept gratefully. Traditionally, gifts, gratification, prosperity, philanthropy.<br><br>Reversed:<br>Lacking the resources to help those in need. Problems paying off debts. Ingratitude. Offers of help turn out to be tied to greater obligations. Possibly a warning to avoid giving loans, there is a good chance they will not be repaid. Traditionally, greed, jealousy, selfishness, imbalance.</p>"
  },
  {
    name: "Seven of Pentacles",
    fileName: "56.jpg",
    home: "VII",
    descr: "<p>Upright:<br>The day to day tasks associated with enterprise. Cultivation. Caring for the crop. Waiting for the harvest, but not idly. Pruning, fertilizing, watering. The hard work and patience required to make things grow. Doing the routine things it takes to stay on the road to prosperity.<br><br>Reversed:<br>Anxiety results in poor quality work. Apprehension about competitors fuels rash decisions. Harvesting before the grain is ready. Working hard for little return, often as a result of impatience. Perhaps insufficient resources are available to do the job properly.</p>"
  },
  {
    name: "Eight of Pentacles",
    fileName: "57.jpg",
    home: "VIII",
    descr: "<p>Upright:<br>Apprenticeship. Craftsmanship. Conscientious and thorough study or work. Focusing on doing it right. The Eight of Pentacles also suggests conscientious and thorough behavior in one’s personal life. Perhaps the subject is diligently adhering to an exercise plan, a healthy diet or a savings plan. Traditionally, candor, practicality, employment, commissions, scholarship.<br><br>Reversed:<br>Overworked. Underpaid. Unsatisfying jobs. Lack of effort or lack of interest in work. Perhaps boredom or poor training lead to frustration and substandard performance. Unemployment may result. Problems saving money or paying bills are also possible. Traditionally, hypocrisy, usury, unreliability, insincerity, lack of ambition.</p>"
  },
  {
    name: "Nine of Pentacles",
    fileName: "58.jpg",
    home: "IX",
    descr: "<p>Upright:<br>Financial independence. Prosperity. Affluence. Comfort. Good health. Possibly a new home. Perhaps a luxurious vacation. Reaping the rewards of all the previous hard work. Traditionally, safety, prudence, success, accomplishments, thoughtfulness, property, contentment.<br><br>Reversed:<br>Still a card of property and money, but the Nine of Pentacles reversed may signal threats or dissatisfaction. The subject may be uncomfortable with the trappings of their situation. Possibly boredom with inherited wealth. Perhaps the wealth was ill-gotten and there is guilt. Perhaps their property is threatened with damage by vandalism or natural disaster. A warning to exercise great care and diligence in real estate transactions. Beware of swindles. Traditionally, trickery, deception, cancelled projects, betrayal, deceit, theft, storms, disappointment.</p>"
  },
  {
    name: "Ten of Pentacles",
    fileName: "59.jpg",
    home: "X",
    descr: "<p>Upright:<br>The achievements of a lifetime. That which is permanent and may be passed on to future generations. The family business. Fortune. Heirlooms. Estates. But also traditions, ancestry, the family name. Wanting to ensure the security, comfort and preservation of the family. This card may be an indication of a coming inheritance, perhaps as the heir, or perhaps as the executor. A card of stable wealth, and also a card of heritage.<br><br>Reversed:<br>The reverse of the upright meaning. Members of the future generation care not for family traditions or ancestors. There is no inheritance, or it is wasted by spendthrift heirs. Greedy family members battling and bickering over the estate, only to find it consumed by debts and taxes. Also, the reversed aspect may represent alienation from the family.</p>"
  },
  {
    name: "Page of Pentacles",
    fileName: "60.jpg",
    home: "II",
    descr: "<p>Upright:<br>A message about health, business or finance, likely good news. Also a suggestion to pay close attention to business matters. The Page, or Princess, of Pentacles is the down to earth child. Analytical. Pragmatic. Hands on. An engineer and a builder. Serious about learning. Serious about money. This is the child who opens a lemonade stand or mows lawns by their own initiative. Traditionally, scholarship, concentration, apprenticeship, work.<br><br>Reversed:<br>Bad news about finance, business, or health issues. Overly materialistic. Obsessed with acquisition. Probably a cheapskate when it comes to spending on other people. Only interested in getting paid, not in doing quality work. Possibly problems studying or understanding assignments. Traditionally, dissipation, degradation, luxury, meddling.</p>"
  },
  {
    name: "Knight of Pentacles",
    fileName: "61.jpg",
    home: "VI",
    descr: "<p>Upright:<br>A person of integrity. Someone who can be counted on. A closer. Dependable. Self sufficient. Conscientious. Persistent. The Knights represent travel, and this Knight in particular suggests travel over natural terrain on foot or by off-road vehicle. Traditionally, interesting, attractive, beneficial, important, helpful, successful.<br><br>Reversed:<br>A workaholic. Focused on advancement and success in the material world, while ignoring the emotional and aesthetic elements of life. Turned inward, perhaps due to excessive devotion to a pursuit such as writing, exercise or meditation. As a result, uninterested in others and apparently boring to them. However, some see this aspect more in the traditional light... burned out, inactive, unwilling to work hard. Traditionally apathetic, stagnant, indolent, discouraged.</p>"
  },
  {
    name: "Queen of Pentacles",
    fileName: "62.jpg",
    home: "X",
    descr: "<p>Upright:<br>A prosperous woman. Resourceful. Fastidious. Conscientious. Perhaps a business owner, or a driving force behind a business. In control of her surroundings and her family. Generous and caring. Confident that she knows the right way to do things. She works hard to ensure the welfare of her loved ones, the quality of her environment, and the success of her ventures. Traditionally, opulence, security, freedom, luxury, sincerity.<br><br>Reversed:<br>The reversed Queen of Pentacles is the opposite of upright, for the most part. She is not generous. She may be insecure and possessive. She may have problems getting things done. She may not pay much attention to the needs of others. She may not be very concerned about her environment. Possibly indicative of financial issues. When looking at health questions, be alert for dietary or digestive problems. Traditionally, suspicious, uncertain, vengeful, apprehensive.</p>"
  },
  {
    name: "King of Pentacles",
    fileName: "63.jpg",
    home: "X",
    descr: "<p>Upright:<br>The Kingdom of Pentacles is the Earthly. The practical and economic facets of life. The King of Pentacles is a leader in monetary matters, and possibly in environmental matters. When representing a person, he is likely to be involved in finance, and to be successful in the business world. A shrewd investor, but interested in value as well as profits. A lover of the finer things, but pragmatic about their acquisition. Perhaps a bit possessive about the people in his life. Steady, stable and dependable. Generous about providing guidance to others. Traditionally, courageous, intelligent, intellectual, loyal. Mathematical aptitudes.<br><br>Reversed:<br>Reversed, the King of Pentacles may become a cheapskate or an exploiter. He may be a business owner who underpays his employees, cheats on taxes or operates dishonestly. Perhaps a slumlord. He may be overly conservative, thereby impeding or preventing progress. He may view people simply as resources. Also, there may be financial problems. Mathematical aptitudes, dependability or pragmatism could be lacking. As the Pentacles represent the Earth, this reversal could suggest environmental carelessness or usury. Traditionally, vice, weakness, ugliness, perversity, corruption, disorder.</p>"
  },
  {
    name: "Ace of Cups",
    fileName: "64.jpg",
    home: "I",
    descr: "<p>Upright:<br>Contentment. Abundance. Fertility. As the Aces represent new beginnings, and the Cups represent love, emotion and family, it is not surprising that the Ace of Cups suggests the start of new relationships, or perhaps family relations growing closer. This card also sometimes portends marriage or childbirth. Traditionally, feasting, opulence, good news, birth, kindness, love.<br><br>Reversed:<br>The opposite of upright for the most part. Relationships in decline. Possibly pretense of affection for underhanded reasons. A hoped for relationship fails to gel, perhaps because it is one sided. When looking at health issues, be wary of digestive or reproductive disorders. Traditionally, erosion, instability, sterility, falseness.</p>"
  },
  {
    name: "Two of Cups",
    fileName: "65.jpg",
    home: "II",
    descr: "<p>Upright:<br>Love, friendship, harmony, union. Relations between the sexes. Sincere and mutual affection. A card of balanced and equal relationships. Possibly a card of engagement and marriage. For established relationships, it may mean a reconciliation is coming or has occurred. Traditionally, love, attraction, passion, kindness, betrothal, partnership.<br><br>Reversed:<br>The opposite. Relationship problems. Disappointment. Disinterest. Disharmony. Imbalance. Perhaps divorce is on the horizon. Lust withough love. Infidelity is possible. Traditionally, jealousy, conflict, separation, illusion.</p>"
  },
  {
    name: "Three of Cups",
    fileName: "66.jpg",
    home: "III",
    descr: "<p>Upright:<br>Successful conclusion of the matter. Perfection. Happiness. Fulfillment. Joining with friends and family to celebrate the good times. Traditionally, merriment, victory, fruitfulness, achievement, abundance.<br><br>Reversed:<br>Not so much opposite as feeling the consequences. A hangover from all the celebration. The results of overindulgence. Possibly growing weary of the party scene. Traditionally, excess, overabundance, conclusion, accidents.</p>"
  },
  {
    name: "Four of Cups",
    fileName: "67.jpg",
    home: "IV",
    descr: "<p>Upright:<br>Boredom. Blessings taken for granted. Daydreams of something newer and more exciting. Perhaps a warning to either appreciate what there is, or move on. Care should also be taken to avoid escapism through alcohol or drugs. Face the situation at hand and deal with it.<br><br>Reversed:<br>Taking actions to alleviate the boredom or pursue the daydream. Moving on. If good things unappreciated are being left behind, this might not represent a favorable result. If the past situation was unsatisfying or unhappy, moving on may be the best choice.</p>"
  },
  {
    name: "Five of Cups",
    fileName: "68.jpg",
    home: "V",
    descr: "<p>Upright:<br>A card of loss, but the loss is not total. Three cups are empty, but two are still full. What remains deserves appreciation. The Five of Cups suggests that it may be time to move on from mourning or self pity. It is a lesson on resiliency. Traditionally, quarrels, separation, sacrifice, regret. There is also a possibility of inheritance.<br><br>Reversed:<br>Two different outcomes may be suggested by the reversed Five of Cups. Traditionally, the subject moves on from mourning and renews connections with family and friends. The opposite interpretation is that inverted, the remaining cups are emptied and nothing is left. Perhaps ultimately, this card represents self-determination. Eventually, inability to move forward after a loss will result in further loss and deterioration of other relationships.</p>"
  },
  {
    name: "Six of Cups",
    fileName: "69.jpg",
    home: "VI",
    descr: "<p>Upright:<br>Nostalgia. Tender moments from childhood, remembered. Trust, security and forgiveness. Memories of happy times and simple pleasures may influence present actions. Perhaps it is time to make up with a loved one after a disagreement. Perhaps the subject is courting or being courted. A face from the past may return. Traditionally, antiquity, memories, aging, longing for the past.<br><br>Reversed:<br>Struggling to break free of old emotional bonds. Rejecting past trauma. Moving on from bitter memories. Focusing on the present and the future. Disillusionment. While the Six of Cups reversed is often described in contemporary interpretations to mean difficulty letting go of the past, traditionally the meanings were more optimistic: regeneration, better times, renewal, future prospects. Perhaps in either aspect, a lesson to treasure the special memories, but avoid becoming their prisoner.</p>"
  },
  {
    name: "Seven of Cups",
    fileName: "70.jpg",
    home: "VII",
    descr: "<p>Upright:<br>Temptations. Choices, perhaps shrouded by deception. Once chosen, the cup may not hold what was expected. Patience and care are advised. Think well and consider what is right before choosing.<br><br>Reversed:<br>Avoidance. Disinterest. Insecurity. Lack of motivation. None of the cups look tempting. This card warns of loss of hope. Help may be needed.</p>"
  },
  {
    name: "Eight of Cups",
    fileName: "71.jpg",
    home: "VIII",
    descr: "<p>Upright:<br>Take a hard look at current situations. Decide whether things are worth continuing. Changes of employment, residence, relationship or lifestyle may result. Walking away from that which is not in one's best interests. Leaving the comfort zone behind and risking the unfamiliar to achieve greater things.<br><br>Reversed:<br>The risk fails. Greater things are not achieved. Return to that which was not worth continuing. Inability to escape from the unsatisfying or unproductive situation, and now things seem worse.</p>"
  },
  {
    name: "Nine of Cups",
    fileName: "72.jpg",
    home: "IX",
    descr: "<p>Upright:<br>A card of joy. Wishes and hopes come true. The answer to the question is positive. Things are going the way they should. Creativity and achievement are at a high. Be sure to enjoy the moment.<br><br>Reversed:<br>Your wish will not come true. Things are not going the way they should. A card of frustration and difficulty.</p>"
  },
  {
    name: "Ten of Cups",
    fileName: "73.jpg",
    home: "X",
    descr: "<p>Upright:<br>Love. Fulfillment. Happiness. Harmony. Closeness of the family. Popularity and acceptance. The Ten of Cups represents the pinnacle of emotional well-being. Traditionally, community, esteem, reputation, contentment.<br><br>Reversed:<br>Alienation. Unhappiness at home. Disappointment in the community. Overwhelmed by family demands. Separation anxiety. The reversed card is pretty well the opposite of the upright. It suggests relationship problems, children going away to college, possibly waning friendships. Traditionally, insult, irritation, pettiness, anger, sorrow.</p>"
  },
  {
    name: "Page of Cups",
    fileName: "74.jpg",
    home: "IV",
    descr: "<p>Upright:<br>A message regarding love or relationship. Possibly news of an engagement or pregnancy. The Pages commonly represent children. The Page, or Princess, of Cups is the affectionate, sensitive, loving, but vulnerable child. When the subject is an adult, this card may suggest that they are feeling some of that sensitivity and vulnerability. If the subject is a child, as with any child they will achieve and develop best in a supportive, nurturing environment. But this child may need a little bit of extra recognition and appreciation. With it, they can achieve great things. Traditionally, helpful, innocent, loyal, studious.<br><br>Reversed:<br>Bad news about love or relationship. Oversensitivity. Overcompensation. Needy of reassurance. Possibly prone to use sexuality and seduction to attract or retain friendships. It may also represent a person who has been hurt in the past and is withdrawn as a result. When the subject is a child, it may suggest imaginary worlds and imaginary friends. Traditionally, weakness, heartache, adoration, supplication.</p>"
  },
  {
    name: "Knight of Cups",
    fileName: "75.jpg",
    home: "IV",
    descr: "<p>Upright:<br>A gentle, caring lover and friend. Sensitive and affectionate. A writer of poems and songs. Thoughtful. Chivalrous. Creative and artistic. Prone to be a dreamer. The Knight of Cups may suggest a proposal is coming. If the context is personal, perhaps it is a good time to focus on artistic and creative endeavors. As with all Knights, a harbinger of travel. In this case, the travel is over water. Perhaps a cruise or a river rafting trip. Traditionally, seduction, charm, proposal, attraction, union.<br><br>Reversed:<br>Repressed or hidden homosexuality is possible. Fear of commitment. Moodiness. Cynicism. Withdrawal. Insecurity. A musician who doesn’t show up for his concert. Evasive. Unhappy. Impossible to please. Beware of travel over water. Traditionally, cheating, trickery, treachery, slander.</p>"
  },
  {
    name: "Queen of Cups",
    fileName: "76.jpg",
    home: "VIII",
    descr: "<p>Upright:<br>A mother figure. A good woman. Loving and giving. A nurturer and healer. Romantic, artistic and creative. Often psychic or intuitive. Excels as a muse, helping others realize their talents.<br><br>Reversed:<br>Excessively needy or clingy. Manipulative. A person who projects nurturing and care, but with hidden motives of control. A sensitive person who could possibly fall victim to addictions or depression.</p>"
  },
  {
    name: "King of Cups",
    fileName: "77.jpg",
    home: "XII",
    descr: "<p>Upright:<br>The Kingdom of Cups includes relationships, feelings, emotions, the heart. The King of Cups is a good and decent man who cares deeply about others. He may be an artist, pastor, pediatrician, perhaps a teacher. He treasures his family and gives his all for their welfare and happiness. His weakness could be that he is too forgiving or soft hearted with family members. He will not be soft hearted or weak if they are threatened, however. Participation in community improvement or charitable organizations is possible. Traditionally, fairness, honesty, integrity, consideration, supportiveness.<br><br>Reversed:<br>Oversensitivity may result in emotional withdrawal due to feeling underappreciated. Possibly prone to escapism through alcohol or substance abuse. Also, this individual may use the loyalty and affection of others against them, perhaps coercing an abused child to keep their abuse secret, perhaps developing a friendship to swindle the supposed friend. Traditionally, dishonorable, double-dealing, injustice, vice, scandal, corruption.</p>"
  }
];

$(".popup, .overlay").click(function(){
  $(".overlay, .popup").fadeOut();
});

var cards = null;
var homeOfCard = null;
var currentDeck = null;
var startTimeout = null;
var reloadTimeout = null;
var extSourceOfImg = "https://raw.githubusercontent.com/alnero/Zipline-data/master/Taro/img/";

var homesArr = [
  [21, 1, 2, 35, 32, 22, 50, 36, 64],
  [3, 4, 60, 23, 51, 37, 65],
  [5, 6, 46, 24, 52, 38, 66],
  [7, 74, 75, 25, 53, 39, 67],
  [8, 33, 26, 54, 40, 68],
  [9, 10, 61, 27, 55, 41, 69],
  [70, 42, 56, 28, 48, 47, 12, 11],
  [71, 43, 57, 29, 76, 14, 13],
  [72, 44, 58, 30, 34, 15],
  [73, 45, 59, 31, 63, 62, 16],
  [49, 18, 17],
  [77, 0, 20, 19]
];

function load(deck){

  $("#main-card, .small-card").removeClass(currentDeck);
  $("#main-card").removeClass("flip");

  currentDeck = deck;
  cards = cardsRiderWaite;

  clearTimeout(startTimeout);
  clearTimeout(reloadTimeout);
            

  $("#main-card, .small-card").addClass(deck);
  $(".front-img").attr("src", extSourceOfImg + "/back.jpg");

  if(homeOfCard){
    $("#" + homeOfCard).removeClass('active-home');
  }

  $("#card-name").animate({opacity: 0}, 0);    
  $(".spinner").animate({opacity: 0}, 0);
  $("#main-card").removeClass("reload");
  $(".small-card").empty();
  $(".card-description p").empty(); 
            
  ["I", "II", "III", "IV", "V", "VI", 
  "VII", "VIII", "IX", "X", "XI", "XII"].forEach(function(home, index){
    var imgContainer = $("<div></div>");
    homesArr[index].forEach(function(card){

      $("<img>").attr("src", extSourceOfImg + card + ".jpg").appendTo(imgContainer);

    });

    $("#" + home + " div").empty();
    $("#" + home).append(imgContainer);
  });

}

load("rider-waite");

$(".cover-img").click(function(){
  clearTimeout(reloadTimeout);

  $(".spinner").animate({opacity: 1}, 0);
  $("#" + homeOfCard).removeClass('active-home');

  reloadTimeout = 
  setTimeout(function(){
    $("#card-name").empty();    
    $(".spinner").animate({opacity: 0}, 0);
    $("#main-card").removeClass("flip");
    $(".front-img").attr("src", extSourceOfImg + "/back.jpg");
    $("#main-card").toggleClass("reload");
    $(".small-card").empty();
    $(".card-description p").empty();   
  }, 300); 
});

$(".front-img").click(function(){
  clearTimeout(startTimeout);

  var card = cards[getRandom()];
  homeOfCard = card.home;
          
  $(".spinner").animate({opacity: 1}, 0);

  startTimeout = 
  setTimeout(function(){
    $(".spinner").animate({opacity: 0}, 0);
                
    $("#card-name").append(card.name);
    if(currentDeck === "rider-waite" && Math.floor(Math.random()*2)) {
      $("#main-card").toggleClass("flip");
    }    
    $("#main-card").addClass("reload");
    $(".front-img").attr("src", extSourceOfImg + card.fileName);
    $("#card-name").animate({opacity: 1}, 0);
    $("#" + homeOfCard).toggleClass('active-home');
    $("<img>").attr("src", extSourceOfImg + card.fileName).appendTo($(".small-card"));
    $(".card-description").append(card.descr);
  }, 2500); 
});

function getRandom(){
  return Math.floor(Math.random()*78);
}
