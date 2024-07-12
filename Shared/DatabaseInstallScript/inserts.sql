use Jul;

# --------INSERTS----------#
INSERT INTO users(username, email, password)
VALUES ('user', 'a20micro@student.his.se', 'password'), ('admin', 'miro96@gmail.com', ''),
('micke', 'a20micro@student.his.se', 'password'), ('gabbe', 'gabbemail@gmail.com', 'password'),
('crippe', 'crippemail@gmail.com', 'password'), ('behrad', 'behradmail@gmail.com', 'password'),
('linus', 'linusmail@gmail.com', 'password'), ('momme', 'mommemail@gmail.com', 'password'), ('doffe', 'doffemail@gmail.com', 'password');

INSERT INTO genre(name)
VALUES ("Action"),("Adventure"),("Animation"),("Biography"),("Comedy"),("Crime"),("CUSTOM RULES"),
("Drama"),("Family"),("Fantasy"),("History"),("Horror"),("Musical"),("Mystery"),
("Romance"),("Science-Fiction"),("Sport"),("Superhero"),("Thriller"),("War"),("Western"),("Wildcard");

INSERT INTO participant(name)
VALUES ("Micke"), ("Gabbe"), ("Crippe"), ("Behrad"), ("Linus"), ("Momme"), ("Victor"), ("Sebbe"), ("Doffer"), ("UNK"), ("Sondre"), ("Adam");

INSERT INTO movie(name, imdb_rating, cover_path, description)
VALUES("Beauty and the beast (live-action)", 7.1, "C:/xampp/htdocs/Julet/Shared/Images/cover.png", "A selfish Prince is cursed to become a monster for the rest of his life, unless he learns to fall in love with a beautiful young woman he keeps prisoner."),
("Catch me if you can", 8.1, "C:/xampp/htdocs/Julet/Shared/Images/cover1.png", "Barely 21 yet, Frank is a skilled forger who has passed as a doctor, lawyer and pilot. FBI agent Carl becomes obsessed with tracking down the con man, who only revels in the pursuit."),
("1917", 8.2, "C:/xampp/htdocs/Julet/Shared/Images/cover2.png", "April 6th, 1917. As an infantry battalion assembles to wage war deep in enemy territory, two soldiers are assigned to race against time and deliver a message that will stop 1,600 men from walking straight into a deadly trap."),
("Rocky IV", 6.8, "C:/xampp/htdocs/Julet/Shared/Images/cover3.png", "Rocky Balboa proudly holds the world heavyweight boxing championship, but a new challenger has stepped forward: Drago, a six-foot-four, 261-pound fighter who has the backing of the Soviet Union."),
("Aliens", 8.4, "C:/xampp/htdocs/Julet/Shared/Images/cover4.png", "Fifty-seven years after surviving an apocalyptic attack aboard her space vessel by merciless space creatures, Officer Ripley awakens from hyper-sleep and tries to warn anyone who will listen about the predators."),
("Spider-Man: Into the spider-verse", 8.4, "C:/xampp/htdocs/Julet/Shared/Images/cover5.png", "Teen Miles Morales becomes the Spider-Man of his universe, and must join with five spider-powered individuals from other dimensions to stop a threat for all realities."),
("The Green Mile", 8.6, "C:/xampp/htdocs/Julet/Shared/Images/cover6.png", "The lives of guards on Death Row are affected by one of their charges: a black man accused of child murder and rape, yet who has a mysterious gift."),
("Sinister", 6.8, "C:/xampp/htdocs/Julet/Shared/Images/cover7.png", "A controversial true crime writer finds a box of super 8 home movies in his new home, revealing that the murder case he is currently researching could be the work of an unknown serial killer whose legacy dates back to the 1960s."),
("Annihilation", 6.8, "C:/xampp/htdocs/Julet/Shared/Images/cover8.png", "A biologist signs up for a dangerous, secret expedition into a mysterious zone where the laws of nature don't apply."),
("Toy Story 3", 8.3, "C:/xampp/htdocs/Julet/Shared/Images/cover9.png", "The toys are mistakenly delivered to a day-care center instead of the attic right before Andy leaves for college, and it's up to Woody to convince the other toys that they weren't abandoned and to return home."),
# 10
("Redline", 7.5, "C:/xampp/htdocs/Julet/Shared/Images/cover10.png", "A story about the most popular racing event in the galaxy, the Redline, and the various racers who compete in it."),
("se7en", 8.6, "C:/xampp/htdocs/Julet/Shared/Images/cover11.png", "Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives."),
("Pulp Fiction", 8.5, "C:/xampp/htdocs/Julet/Shared/Images/cover12.png", "The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption."),
("The Babadook", 6.8, "C:/xampp/htdocs/Julet/Shared/Images/cover13.png", "A single mother and her child fall into a deep well of paranoia when an eerie children's book titled 'Mister Babadook' manifests in their home."),
("The Ballad of Buster Scruggs", 7.3, "C:/xampp/htdocs/Julet/Shared/Images/cover14.png", "Six tales of life and violence in the Old West, following a singing gunslinger, a bank robber, a traveling impresario, an elderly prospector, a wagon train, and a perverse pair of bounty hunters."),
("Joker", 8.4, "C:/xampp/htdocs/Julet/Shared/Images/cover15.png", "A mentally troubled stand-up comedian embarks on a downward spiral that leads to the creation of an iconic villain."),
("American Psycho", 7.6, "C:/xampp/htdocs/Julet/Shared/Images/cover16.png", "A wealthy New York City investment banking executive, Patrick Bateman, hides his alternate psychopathic ego from his co-workers and friends as he delves deeper into his violent, hedonistic fantasies."),
("Inglorious basterds", 8.3, "C:/xampp/htdocs/Julet/Shared/Images/cover17.png", "In Nazi-occupied France during World War II, a plan to assassinate Nazi leaders by a group of Jewish U.S. soldiers coincides with a theatre owner's vengeful plans for the same."),
("A bug's life", 7.2, "C:/xampp/htdocs/Julet/Shared/Images/cover18.png", "A misfit ant, looking for 'warriors' to save his colony from greedy grasshoppers, recruits a group of bugs that turn out to be an inept circus troupe."),
("Zootopia", 8, "C:/xampp/htdocs/Julet/Shared/Images/cover19.png", "In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy."),
# 20
("Treasure planet", 7.2, "C:/xampp/htdocs/Julet/Shared/Images/cover20.png", "In this science fiction rendering of the classic novel 'Treasure Island', Jim Hawkins (Joseph Gordon-Levitt) is a rebellious teen seen by the world as an aimless slacker. After he receives a map from a dying pirate, he embarks on an odyssey across the universe to find the legendary Treasure Planet."),
("The Wolf of Wall Street", 8.2, "C:/xampp/htdocs/Julet/Shared/Images/cover21.png", "Based on the true story of Jordan Belfort, from his rise to a wealthy stock-broker living the high life to his fall involving crime, corruption and the federal government."),
("The revenant", 8, "C:/xampp/htdocs/Julet/Shared/Images/cover22.png", "A frontiersman on a fur trading expedition in the 1820s fights for survival after being mauled by a bear and left for dead by members of his own hunting team."),
("Alita: Battle Angel", 7.3, "C:/xampp/htdocs/Julet/Shared/Images/cover23.png", "A deactivated cyborg's revived, but can't remember anything of her past and goes on a quest to find out who she is."),
("Baby Driver", 7.6, "C:/xampp/htdocs/Julet/Shared/Images/cover24.png", "After being coerced into working for a crime boss, a young getaway driver finds himself taking part in a heist doomed to fail."),
("Lilo & Stitch", 7.3, "C:/xampp/htdocs/Julet/Shared/Images/cover25.png", "A young and parentless girl adopts a 'dog' from the local pound, completely unaware that it's supposedly a dangerous scientific experiment that's taken refuge on Earth and is now hiding from its creator and those who see it as a menace."),
("Hot Fuzz", 7.8, "C:/xampp/htdocs/Julet/Shared/Images/cover26.png", "A skilled London police officer, after irritating superiors with his embarrassing effectiveness, is transferred to a village where the easygoing officers object to his fervor for regulations, as a string of grisly murders strikes the town."),
("Braveheart", 8.4, "C:/xampp/htdocs/Julet/Shared/Images/cover27.png", "Scottish warrior William Wallace leads his countrymen in a rebellion to free his homeland from the tyranny of King Edward I of England."),
("Dodgeball: A True Underdog Story", 6.7, "C:/xampp/htdocs/Julet/Shared/Images/cover28.png", "A group of misfits enter a Las Vegas dodgeball tournament in order to save their cherished local gym from the onslaught of a corporate health fitness chain."),
("The Pianist", 8.5, "C:/xampp/htdocs/Julet/Shared/Images/cover29.png", "A Polish Jewish musician struggles to survive the destruction of the Warsaw ghetto of World War II."),
# 30
("Edward Scissorhands", 7.9, "C:/xampp/htdocs/Julet/Shared/Images/cover30.png", "The solitary life of an artificial man - who was incompletely constructed and has scissors for hands - is upended when he is taken in by a suburban family."),
("John Wick", 7.4, "C:/xampp/htdocs/Julet/Shared/Images/cover31.png", "An ex-hit-man comes out of retirement to track down the gangsters that killed his dog and took his car."),
("The Batman", 7.8, "C:/xampp/htdocs/Julet/Shared/Images/cover32.png", "When a sadistic serial killer begins murdering key political figures in Gotham, Batman is forced to investigate the city's hidden corruption and question his family's involvement."),
("Bee Movie", 6.1, "C:/xampp/htdocs/Julet/Shared/Images/cover33.png", "Barry B. Benson, a bee just graduated from college, is disillusioned at his lone career choice: making honey. On a special trip outside the hive, Barry's life is saved by Vanessa, a florist."),
("The Hunchback of Notre Dame", 7.0, "C:/xampp/htdocs/Julet/Shared/Images/cover34.png", "A deformed bell-ringer must assert his independence from a vicious government minister in order to help his friend, a gypsy dancer."),
("127 Hours", 7.5, "C:/xampp/htdocs/Julet/Shared/Images/cover35.png", "A mountain climber becomes trapped under a boulder while canyoneering alone near Moab, Utah and resorts to desperate measures in order to survive."),
("Cars 2", 6.2, "C:/xampp/htdocs/Julet/Shared/Images/cover36.png", "Star race car Lightning McQueen and his pal Mater head overseas to compete in the World Grand Prix race. But the road to the championship becomes rocky as Mater gets caught up in an intriguing adventure of his own: international espionage."),
("Everything Everywhere All at Once", 7.8, "C:/xampp/htdocs/Julet/Shared/Images/cover37.png","A middle-aged Chinese immigrant is swept up into an insane adventure in which she alone can save existence by exploring other universes and connecting with the lives she could have led."),
("District 9", 7.9, "C:/xampp/htdocs/Julet/Shared/Images/cover38.png", "Violence ensues after an extraterrestrial race forced to live in slum-like conditions on Earth finds a kindred spirit in a government agent exposed to their biotechnology."),
("Indiana Jones: Raiders of the Lost Ark", 8.4, "C:/xampp/htdocs/Julet/Shared/Images/cover39.png", "In 1936, archaeologist and adventurer Indiana Jones is hired by the U.S. government to find the Ark of the Covenant before the Nazis can obtain its awesome powers."),
# 40
("Life of Brian", 8, "C:/xampp/htdocs/Julet/Shared/Images/cover40.png", "Born on the original Christmas in the stable next door to Jesus Christ, Brian of Nazareth spends his life being mistaken for a messiah."),
("Gremlins", 7.3, "C:/xampp/htdocs/Julet/Shared/Images/cover41.png", "A young man inadvertently breaks three important rules concerning his new pet and unleashes a horde of malevolently mischievous monsters on a small town."),
("Cruella", 7.3, "C:/xampp/htdocs/Julet/Shared/Images/cover42.png", "A live-action prequel feature film following a young Cruella de Vil."),
("The Hunger Games", 7.2, "C:/xampp/htdocs/Julet/Shared/Images/cover43.png", "Katniss Everdeen voluntarily takes her younger sister's place in the Hunger Games: a televised competition in which two teenagers from each of the twelve Districts of Panem are chosen at random to fight to the death."),
("Cast Away", 7.8, "C:/xampp/htdocs/Julet/Shared/Images/cover44.png", "A FedEx executive undergoes a physical and emotional transformation after crash landing on a deserted island."),
("Iron Giant", 8.1, "C:/xampp/htdocs/Julet/Shared/Images/cover45.png", "A young boy befriends a giant robot from outer space that a paranoid government agent wants to destroy."),
("Captain America: The First Avenger", 6.9, "C:/xampp/htdocs/Julet/Shared/Images/cover46.png", "Steve Rogers, a rejected military soldier, transforms into Captain America after taking a dose of a \"Super-Soldier serum\". But being Captain America comes at a price as he attempts to take down a warmonger and a terrorist organization."),
("Captain Marvel", 6.8, "C:/xampp/htdocs/Julet/Shared/Images/cover47.png", "Carol Danvers becomes one of the universe's most powerful heroes when Earth is caught in the middle of a galactic war between two alien races."),
("Iron Man", 7.9, "C:/xampp/htdocs/Julet/Shared/Images/cover48.png", "After being held captive in an Afghan cave, billionaire engineer Tony Stark creates a unique weaponized suit of armor to fight evil."),
("Iron Man 2", 6.9, "C:/xampp/htdocs/Julet/Shared/Images/cover49.png", "With the world now aware of his identity as Iron Man, Tony Stark must contend with both his declining health and a vengeful mad man with ties to his father's legacy."),
# 50
("The Incredible Hulk", 6.6, "C:/xampp/htdocs/Julet/Shared/Images/cover50.png", "Bruce Banner, a scientist on the run from the U.S. Government, must find a cure for the monster he turns into whenever he loses his temper."),
("Thor", 7, "C:/xampp/htdocs/Julet/Shared/Images/cover51.png", "The powerful but arrogant god Thor is cast out of Asgard to live amongst humans in Midgard (Earth), where he soon becomes one of their finest defenders."),
("Thor: The Dark World", 6.8, "C:/xampp/htdocs/Julet/Shared/Images/cover52.png", "When the Dark Elves attempt to plunge the universe into darkness, Thor must embark on a perilous and personal journey that will reunite him with doctor Jane Foster."),
("Iron Man 3", 7.1, "C:/xampp/htdocs/Julet/Shared/Images/cover53.png", "When Tony Stark's world is torn apart by a formidable terrorist called the Mandarin, he starts an odyssey of rebuilding and retribution."),
("Captain America: The Winter Soldier", 7.8, "C:/xampp/htdocs/Julet/Shared/Images/cover54.png", "As Steve Rogers struggles to embrace his role in the modern world, he teams up with a fellow Avenger and S.H.I.E.L.D agent, Black Widow, to battle a new threat from history: an assassin known as the Winter Soldier."),
("Guardians of the Galaxy", 8, "C:/xampp/htdocs/Julet/Shared/Images/cover55.png", "A group of intergalactic criminals must pull together to stop a fanatical warrior with plans to purge the universe."),
("Guardians of the Galaxy Vol. 2", 7.6, "C:/xampp/htdocs/Julet/Shared/Images/cover56.png", "The Guardians struggle to keep together as a team while dealing with their personal family issues, notably Star-Lord's encounter with his father, the ambitious celestial being Ego."),
("Avengers: Age of Ultron", 7.3, "C:/xampp/htdocs/Julet/Shared/Images/cover57.png", "When Tony Stark and Bruce Banner try to jump-start a dormant peacekeeping program called Ultron, things go horribly wrong and it's up to Earth's mightiest heroes to stop the villainous Ultron from enacting his terrible plan."),
("Ant-Man", 7.3, "C:/xampp/htdocs/Julet/Shared/Images/cover58.png", "Armed with a super-suit with the astonishing ability to shrink in scale but increase in strength, cat burglar Scott Lang must embrace his inner hero and help his mentor, Dr. Hank Pym, pull off a plan that will save the world."),
("Captain America: Civil War", 7.8, "C:/xampp/htdocs/Julet/Shared/Images/cover59.png", "Political involvement in the Avengers' affairs causes a rift between Captain America and Iron Man."),
# 60
("Spider-Man: Homecoming", 7.4, "C:/xampp/htdocs/Julet/Shared/Images/cover60.png", "Peter Parker balances his life as an ordinary high school student in Queens with his superhero alter-ego Spider-Man, and finds himself on the trail of a new menace prowling the skies of New York City."),
("Black Panther",7.3 , "C:/xampp/htdocs/Julet/Shared/Images/cover61.png", "T'Challa, heir to the hidden but advanced kingdom of Wakanda, must step forward to lead his people into a new future and must confront a challenger from his country's past."),
("Black Widow", 6.7, "C:/xampp/htdocs/Julet/Shared/Images/cover62.png", "Natasha Romanoff confronts the darker parts of her ledger when a dangerous conspiracy with ties to her past arises."),
("Doctor Strange", 7.5, "C:/xampp/htdocs/Julet/Shared/Images/cover63.png", "While on a journey of physical and spiritual healing, a brilliant neurosurgeon is drawn into the world of the mystic arts."),
("Thor: Ragnarök", 7.9, "C:/xampp/htdocs/Julet/Shared/Images/cover64.png", "Imprisoned on the planet Sakaar, Thor must race against time to return to Asgard and stop Ragnarök, the destruction of his world, at the hands of the powerful and ruthless villain Hela."),
("Ant-Man and the Wasp", 7, "C:/xampp/htdocs/Julet/Shared/Images/cover65.png", "As Scott Lang balances being both a superhero and a father, Hope van Dyne and Dr. Hank Pym present an urgent new mission that finds the Ant-Man fighting alongside The Wasp to uncover secrets from their past."),
("Avengers: Infinity War", 8.4, "C:/xampp/htdocs/Julet/Shared/Images/cover66.png", "The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe."),
("Avengers: Endgame", 8.4, "C:/xampp/htdocs/Julet/Shared/Images/cover67.png", "After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos' actions and restore balance to the universe."),
("Spider-Man: Far from Home", 7.4, "C:/xampp/htdocs/Julet/Shared/Images/cover68.png", "Following the events of Avengers: Endgame (2019), Spider-Man must step up to take on new threats in a world that has changed forever."),
("Spider-Man: No Way Home", 8.2, "C:/xampp/htdocs/Julet/Shared/Images/cover69.png", "With Spider-Man's identity now revealed, Peter asks Doctor Strange for help. When a spell goes wrong, dangerous foes from other worlds start to appear, forcing Peter to discover what it truly means to be Spider-Man."),
# 70
("Shang-Chi and The Legend of the Ten Rings", 7.4, "C:/xampp/htdocs/Julet/Shared/Images/cover70.png", "Shang-Chi, the master of weaponry-based Kung Fu, is forced to confront his past after being drawn into the Ten Rings organization."),
("Eternals", 6.3, "C:/xampp/htdocs/Julet/Shared/Images/cover71.png", "The saga of the Eternals, a race of immortal beings who lived on Earth and shaped its history and civilizations."),
("Doctor Strange in the Multiverse of Madness", 6.9, "C:/xampp/htdocs/Julet/Shared/Images/cover72.png", "Doctor Strange teams up with a mysterious teenage girl from his dreams who can travel across multiverses, to battle multiple threats, including other-universe versions of himself, which threaten to wipe out millions across the multiverse. They seek help from Wanda the Scarlet Witch, Wong and others."),
("Thor: Love and Thunder", 6.2, "", "Thor enlists the help of Valkyrie, Korg and ex-girlfriend Jane Foster to fight Gorr the God Butcher, who intends to make the gods extinct."),
("Black Panther: Wakanda Forever", 6.7, "", "The people of Wakanda fight to protect their home from intervening world powers as they mourn the death of King T'Challa."),
("Ant-Man and the Wasp: Quantumania", 6.1, "", "Scott Lang and Hope Van Dyne are dragged into the Quantum Realm, along with Hope's parents and Scott's daughter Cassie. Together they must find a way to escape, but what secrets is Hope's mother hiding? And who is the mysterious Kang?"),
("Guardians of the Galaxy Vol. 3", 7.9, "", "Still reeling from the loss of Gamora, Peter Quill rallies his team to defend the universe and one of their own - a mission that could mean the end of the Guardians if not successful."),
("Venom", 6.6, "", "A failed reporter is bonded to an alien entity, one of many symbiotes who have invaded Earth. But the being takes a liking to Earth and decides to protect it."),
("Venom: Let There Be Carnage", 5.9, "", "Eddie Brock attempts to reignite his career by interviewing serial killer Cletus Kasady, who becomes the host of the symbiote Carnage and escapes prison after a failed execution."),
("Morbius", 5.2, "", "Biochemist Michael Morbius tries to cure himself of a rare blood disease, but he inadvertently infects himself with a form of vampirism instead."),
# 80
("Spider-Man", 7.4, "", "After being bitten by a genetically-modified spider, a shy teenager gains spider-like abilities that he uses to fight injustice as a masked superhero and face a vengeful enemy."),
("Spider-Man 2", 7.5, "", "Peter Parker is beset with troubles in his failing personal life as he battles a former brilliant scientist named Otto Octavius."),
("Spider-Man 3", 6.3, "", "A strange black entity from another world bonds with Peter Parker and causes inner turmoil as he contends with new villains, temptations, and revenge."),
("The Amazing Spider-Man", 6.9, "", "After Peter Parker is bitten by a genetically altered spider, he gains newfound, spider-like powers and ventures out to save the city from the machinations of a mysterious reptilian foe."),
("Les Misérables", 7.5, "", "In 19th-century France, Jean Valjean, who for decades has been hunted by the ruthless policeman Javert after breaking parole, agrees to care for a factory worker's daughter. The decision changes their lives forever."),
("The Prestige", 8.5, "", "After a tragic accident, two stage magicians in 1890s London engage in a battle to create the ultimate illusion while sacrificing everything they have to outwit each other."),
("Encanto", 7.2, "", "A Colombian teenage girl has to face the frustration of being the only member of her family without magical powers."),
("Spider-Man: Into the Spider-Verse", 8.4, "", "Teen Miles Morales becomes the Spider-Man of his universe and must join with five spider-powered individuals from other dimensions to stop a threat for all realities."),
("Spider-Man: Across the Spider-Verse", 8.7, "", "Miles Morales catapults across the multiverse, where he encounters a team of Spider-People charged with protecting its very existence. When the heroes clash on how to handle a new threat, Miles must redefine what it means to be a hero."),
("Moana", 7.6, "", "In Ancient Polynesia, when a terrible curse incurred by the Demigod Maui reaches Moana's island, she answers the Ocean's call to seek out the Demigod to set things right."),
# 90
("Frozen", 7.4, "", "When the newly crowned Queen Elsa accidentally uses her power to turn things into ice to curse her home in infinite winter, her sister Anna teams up with a mountain man, his playful reindeer, and a snowman to change the weather condition."),
("Inside Out", 8.1, "", "After young Riley is uprooted from her Midwest life and moved to San Francisco, her emotions - Joy, Fear, Anger, Disgust and Sadness - conflict on how best to navigate a new city, house, and school."),
("The Little Mermaid", 7.2, "", "A young mermaid makes a deal with a sea witch to trade her beautiful voice for human legs so she can discover the world above water and impress a prince."),
("Prince of Egypt", 7.2, "", "Egyptian Prince Moses learns of his identity as a Hebrew and his destiny to become the chosen deliverer of his people."),
("How To Train Your Dragon", 8.1, "", "A hapless young Viking who aspires to hunt dragons becomes the unlikely friend of a young dragon himself, and learns there may be more to the creatures than he assumed."),
("Elemental", 7, "", "Follows Ember and Wade, in a city where fire-, water-, earth- and air-residents live together."),
("Konferensen", 5.7, "", "A team-building conference for municipal employees turns into a nightmare when accusations of corruption begin to circulate and plague the work environment. At the same time, a mysterious figure begins murdering the participants."),
("Whiplash", 8.5, "", "A promising young drummer enrolls at a cut-throat music conservatory where his dreams of greatness are mentored by an instructor who will stop at nothing to realize a student's potential."),
("Frozen 2", 6.8, "", "Anna, Elsa, Kristoff, Olaf and Sven leave Arendelle to travel to an ancient, autumn-bound forest of an enchanted land. They set out to find the origin of Elsa's powers in order to save their kingdom."),
("Guillermo del Toro's Pinocchio", 7.6, "", "A father's wish magically brings a wooden boy to life in Italy, giving him a chance to care for the child."),
# 100
("Spider-Man: Across the Spider-Verse", 8.6, "", "Miles Morales catapults across the multiverse, where he encounters a team of Spider-People charged with protecting its very existence. When the heroes clash on how to handle a new threat, Miles must redefine what it means to be a hero."),
("The Avengers", 8.0, "", "Earth's mightiest heroes must come together and learn to fight as a team if they are going to stop the mischievous Loki and his alien army from enslaving humanity."),
("The Marvels", 8.0, "", "Carol Danvers gets her powers entangled with those of Kamala Khan and Monica Rambeau, forcing them to work together to save the universe."),
("Dredd", 7.1, "", "In a violent, futuristic city where the police have the authority to act as judge, jury and executioner, a cop teams with a trainee to take down a gang that deals the reality-altering drug, SLO-MO."),
("Donnie Brasco", 7.7, "", "An FBI undercover agent infiltrates the mob and finds himself identifying more with the Mafia life--at the expense of his regular one."),
("Madame Web", 3.9, "", "Cassandra Webb is a New York metropolis paramedic who begins to demonstrate signs of clairvoyance. Forced to challenge revelations about her past, she needs to safeguard three young women from a deadly adversary who wants them destroyed."),
("Eurovision Song Contest: The Story of Fire Saga", 6.5, "", "When aspiring musicians Lars and Sigrit are given the opportunity to represent their country at the world's biggest song competition, they finally have a chance to prove that any dream worth having is a dream worth fighting for."),
("Van Helsing", 6.1, "", "The famed monster hunter is sent to Transylvania to stop Count Dracula, who is using Dr. Frankenstein's research and a werewolf for nefarious purposes."),
("Idiocracy", 6.5, "", "Corporal Joe Bauers, a decidedly average American, is selected for a top-secret hibernation program but is forgotten and left to awaken to a future so incredibly moronic that he's easily the most intelligent person alive."),
("The Platform", 7.0, "", "A vertical prison with one cell per level. Two people per cell. Only one food platform and two minutes per day to feed. An endless nightmare trapped in The Hole."),
# 110
("The Grand Budapest Hotel", 8.1, "", "A writer encounters the owner of an aging high-class hotel, who tells him of his early years serving as a lobby boy in the hotel's glorious years under an exceptional concierge."),
("Weird: The Al Yankovic Story", 6.9, "", "Explores every facet of Yankovic's life, from his meteoric rise to fame with early hits like 'Eat It' and 'Like a Surgeon' to his torrid celebrity love affairs and famously depraved lifestyle.");

INSERT INTO group_movie(movie_id, genre_name, picked_by, jayornay, is_major)
VALUES
(1, "Romance", 2, "Jay", 1),
(2, "Biography", 2, "Jay", 1),
(3, "War", 1, "Jay", 0),
(4, "Sport", 6, "Mexican Standoff", 1),
(5, "Wildcard", 5, "Jay", 1),
(6, "Family", 4, "Jay", 1),
(7, "Crime", 1, "Jay", 1),
(8, "Horror", 5, "Jay", 1),
(9, "Science-Fiction", 5, "Nay", 1),
(10, "Fantasy", 1, "Jay", 0),
(11, "Animation", 3, "Mexican Standoff", 1),
(12, "mystery", 4, "Jay", 0),
(13, "CUSTOM RULES", 6, "Jay", 0),
(14, "Wildcard", 3, "Jay", 0),
(15, "Drama", 1, "Jay", 1),
(16, "Wildcard", 4, "Jay", 0),
(17, "Crime", 1, "Jay", 0),
(18, "War", 3, "Jay", 0),
(19, "Adventure", 1, "Jay", 0),
(20, "Crime", 1, "Jay", 0),
(21, "Animation", 2, "Jay", 1),
(22, "Biography", 3, "Jay", 0),
(23, "Western", 3, "Meixcan Standoff", 0),
(24, "CUSTOM RULES", 1, "Jay", 0),
(25, "Crime", 1, "Jay", 0),
(26, "Fantasy", 6, "Jay", 0),
(27, "Mystery", 3, "Jay", 1),
(28, "Biography", 3, "Nay", 0),
(29, "Sport", 1, "Jay", 0),
(30, "Biography", 1, "Jay", 0),
(31, "Fantasy", 1, "Jay", 0),
(32, "Wildcard", 1, "Jay", 0),
(33, "Superhero", 4, "Jay", 1),
(34, "Drama", 1, "Jay", 0),
(35, "Animation", 1, "Jay", 0),
(36, "Biography", 1, "Jay", 0),
(37, "Mystery", 1, "Nay", 0),
(38, "CUSTOM RULES", 1, "Jay", 0),
(39, "CUSTOM RULES", 1, "Jay", 0),
(40, "Action", 9, "Jay", 0),
(41, "CUSTOM RULES", 3, "Jay", 1),
(42, "CUSTOM RULES", 2, "Nay", 0),
(43, "Crime", 9, "Jay", 0),
(44, "Thriller", 2, "Nay", 1),
(45, "CUSTOM RULES", 3, "Jay", 0),
(46, "Family", 1, "Jay", 0),
(104, "Science-Fiction", 3, "Nay", 1),
(85, "CUSTOM RULES", 1, "Jay", 0),
(110, "Horror", 1, "Nay", 1);

INSERT INTO marvel_movie(movie_id)
VALUES
(47),(48),(49),(50),(51),(52),(102),(53),(54),(55),
(56),(57),(58),(59),(60),(61),(62),(63),(64),(65),
(66),(67),(68),(69),(70),(71),(72),(73),(74),(75),
(76),(77),(78),(79),(80),(81),(82),(83),(84), (103),
(106);

INSERT INTO marvel_participated(marvel_movie_entry_id, user_id, user_rating)
VALUES
(1,1,4), (1,2,6), (1,3,7), (1,6,7),
(2,1,6), (2,2,8), (2,3,8),
(3,1,3), (3,2,7), (3,3,7), (3,6,6),
(4,1,1), (4,2,5), (4,3,6), (4,6,7),
(5,1,3), (5,2,5), (5,3,4),
(6,1,4), (6,2,6), (6,3,5), (6,4,7),
(7,1,7), (7,2,8), (7,3,8), (7,6,7),
(8,1,4), (8,2,5), (8,3,5), (8,7,5),
(9,1,4), (9,2,6), (9,3,7),
(10,1,1), (10,2,4), (10,3,4), (10,6,3),
(11,1,4), (11,2,7), (11,3,7), (11,6,5),
(12,1,7), (12,2,8), (12,3,6), (12,6,8),
(13,1,9), (13,2,5), (13,3,5), (13,6,4),
(14,1,1), (14,2,5), (14,3,4),
(15,1,6), (15,2,5), (15,3,5), (15,6,4),
(16,1,9), (16,2,7), (16,3,9), (16,6,8),
(17,1,1), (17,2,2), (17,3,3),
(18,1,7), (18,2,8), (18,3,8),
(19,1,10), (19,2,7), (19,3,9), (19,4,8), 
(20,1,1), (20,2,1), (20,3,1), (20,4,1), (20,6,3),
(21,1,1), (21,2,1), (21,3,1), (21,4,1), (21,6,3),
(22,2,10), (22,1,10), (22,3,7), (22,4,9), (22,6,9),
(23,2,10), (23,1,9), (23,3,7), (23,4,9), (23,6,7),
(24,2,8), (24,1,7), (24,3,8), (24,4,9), (24,6,6), (24,7,7),
(25,2,9), (25,1,10), (25,3,9), (25,4,8), (25,6,9),
(26,2,5), (26,1,2), (26,3,3), (26,4,4), (26,6,4), 
(27,2,3), (27,1,1), (27,3,2), (27,4,5), (27,6,5),
(28,2,7), (28,1,9), (28,3,9), (28,4,7), (28,5,9), (28,6,9),
(29,2,7), (29,1,6), (29,3,4), (29,4,4), (29,5,5), (29,6,6),
(30, 1, 4), (30, 2, 7), (30, 3, 3), (30, 4, 7), (30, 5, 6),
(31, 1, 1), (31, 2, 1), (31, 3, 1), (31, 5, 2), (31, 9, 3), (31, 11, 1),
(32, 1, 8), (32, 2, 7), (32, 3, 8),
(33, 1, 3), (33, 2, 5), (33, 3, 5), (33, 6, 3), (33, 12, 6),
(34, 1, 9), (34, 2, 6), (34, 3, 7), (34, 6, 3), (34, 12, 3),
(35, 1, 5), (35, 2, 1), (35, 3, 1), (35, 6, 2),
(36, 1, 9), (36, 2, 7), (36, 3, 6),
(37, 1, 10), (37, 2, 8), (37, 3, 7), (37, 11, 10),
(38, 1, 6), (38, 2, 4), (38, 3, 5), (38, 4, 7),
(39, 1, 3), (39, 2, 1), (39, 3, 1),
(40, 1, 9), (40, 2, 5), (40, 3, 4),
(41, 1, 1), (41, 2, 1), (41, 3, 1);

INSERT INTO participated(movieID, participantID)
VALUES (1,1), (1,2), (1,3), (2,1), (2,2), (2,3), (2,4), (3,1), (3,2), (4,1), (4,2), (4,3), (4,6), (5,1), (5,2), (5,3), (5,5), (6,1), (6,2), (6,3), (6,4), (6,5), (7,1), (7,2), (7,3), (7,5),
(8,1), (8,2), (8,3), (8,5), (9,1), (9,2), (9,3), (9,5), (10,1), (10,5), (10,8), (11,1), (11,2), (11,3), (11,5), (12,1), (12,3), (12,4), (12,5), (12,6), (12,7), (13,1), (13,6), (14,1), (14,3), 
(14,5), (15,1), (15,2), (15,3), (15,4), (15,6), (15,7), (16,1), (16,3), (16,4), (16,5), (16,6), (17,1), (17,4), (17,5), (18,1), (18,3), (18,4), (18,5), (19,1), (19,3), (19,5), (20,1), (20,3), 
(20,4), (20,5), (20,6), (21,1), (21,2), (21,3), (21,5), (22,1), (22,3), (22,4), (22,5), (23,1), (23,3), (24,1), (24,3), (24,4), (25,1), (25,3), (25,5), (26,1), (26,3), (26,4), (26,6),
(27, 1), (27, 2), (27, 3), (27, 4), (27, 5), (27, 6), (28, 1), (28, 3), (28, 4), (28, 5), (29, 1), (29, 3), (29, 4), (29, 5), (30, 1), (30, 3), (30, 4), (30, 6), (31, 1), (31, 3), (31, 6), 
(31, 7), (32, 1), (32, 3), (32, 5), (33, 1), (33, 2), (33, 3), (33, 4), (34, 1), (34, 4), (34, 6), (35, 1), (35, 3), (35, 4), (35, 5), (35, 6), (36, 1), (36, 3), (36, 6), (36, 9), (37, 1),
(37, 3), (37, 12), (38, 1), (38, 3), (39, 1), (39, 3), (40, 1), (40, 2), (40, 9), (41, 1), (41, 2), (41, 3), (42, 1), (42, 2), (42, 3), (43, 1), (43, 3), (43, 9),
(44, 1), (44, 2), (44, 3), (45, 1), (45, 3), (46, 1), (46, 3), (104, 1), (104, 2), (104, 3), (85, 1), (85, 3), (85, 9);

INSERT INTO solo_movie(movie_id, user_id, user_rating)
VALUES (85, 1, 8), (85, 3, 2),
(86, 1, 10), (86, 3, 9), 
(87, 1, 9),
(6, 1, 9), 
(101, 1, 9), 
(46, 1, 7), 
(90, 1, 6),
(91, 1, 9), 
(92, 1, 9), 
(93, 1, 8), (93, 2, 6),
(94, 1, 7), (94, 2, 10), 
(95, 1, 8), (95, 2, "8"), 
(96, 1, 9), (96, 2, 7), (96, 9, 8), 
(97, 1, 4), (97, 9, 4),
(98, 1, 9), (98, 3, 8), 
(99, 1, 6), 
(100, 1, 8), (100, 2, 6), 
(105, 1, 6), (105, 2, 5), (105, 3, 6),(105, 6, 0), 
(107, 1, 6), (107, 3, 4),
(108, 1, 6), (108, 2, 5),
(109, 1, 8), (109, 2, 5), (109, 2, 6),
(111, 1, 10), (111, 4, 8),
(112, 1, 8);

INSERT INTO movie_club_role(role_name)
VALUES("Owner"), ("Admin"), ("Event_Manager"), ("User");

INSERT INTO movie_club(club_owner, club_name, club_description, club_creation_date)
VALUES(3, "First Movie Club", "First club created on this website, managed by Micke.", "2024-07-12 23:19:13");

INSERT INTO club_member(club_id, user_id, user_joined, club_role)
VALUES(1, 3, "2024-07-12 23:19:13", 1), (1, 4, "2024-07-12 23:19:13", 2), (1, 5, "2024-07-12 23:19:13", 2), (1, 6, "2024-07-12 23:19:13", 2);

INSERT INTO movie_club_deadline(club_id, movie_id, creator_id, deadline, deadline_comment, notification_time, change_role_req)
VALUES(1, 37, 3, "2024-07-22 23:19:13", "This is a comment that will be shown in association with the deadline. Hopefully.", 24, 2);

INSERT INTO rule(rule_name, rule_description)
VALUES("Regular Wheel (2+)", "This is a simple Jul. Each participant brings a single movie to the Jul, the Jul is spun and whatever movie it lands on is the winner."),
("Reverse Wheel (2+)", "Reverse Jul. Every participant brings a movie to the Jul, the Jul is spun and the winning result is removed from the Jul. The Jul is then re-spun until only 1 remains which is the winner."),
("Dealers choice (3+)", "Each user brings a movie to the Jul, but instead of spinning the movies, the users names are spun. The one it lands on gets to decide between the movies the other users brought."),
("Multi-choice Wheel (1+)", "Each user brings more than one movie to the Jul. Can be combined with other rules to create Reverse-Multi-Wheels of madness."),
("Reverse Multi-wheel of madness (1+)", "Each user brings multiple movies (often 3 or 5), either from the same or diffrent genres, and one movie is removed per roll. God help you if you don't have 30 minutes to spare."),
("Reverse-Genre Wheel Of Reverse Madness (1+)", "Every user bring 3-5 genres to the Jul and a reverse Jul is spun. Then each user brings 3-5 movies from the remaining genre and a revser Jul is spun again. WARNING! WILL TAKE AT LEAST 30 MINUTES."),
("Tag-Team Wheel (3+)", "First a Jul is spun between the participant and whoever it lands on decides the genre. The rest of the participants bring a movie of the chosen genre and a regular Jul is spun to determine the winner."),
("Bogo-Wheel (2+)", "Regular or reverse Jul with a number of \"RESET\" entries. If the RESET entry is chosen, the previous user-brought entries are disqualified and new entries must be brought."),
("Streaming Site Jul (2+)", "Instead of movies, streaming sites are either brought to the Jul, or a complete list of streaming sites are brought to be rolled. The chosen streaming site is used to select movies for further Jul."),
("Time-Wheel (1+)", "Every full hour is added to a wheel (00 - 24) and a wheel is then spun. A normal wheel is then spun at the rolled hour of the next day."),
("Winner Wheel (2+)", "The name of the participants are added to the Jul and the Jul is then spun. Whoever it lands on gets to pick a movie for a secondary Jul from any genre. The Jul is then respun until X amount of movies exists on the secondary Jul. The secondary Jul is then spun and a winning movie is chosen."),
("Custom Wheel", "Custom rules are prepared beforehand in terms of movie selection criterias. Too specific to handle all cases and it's represented as 'CUSTOM RULES' in the movie table.");

INSERT INTO activity_log(username, action, timestamp, data)
VALUES("user", "pageview", '2019-12-19 17:07:06', '{"page_ulr":"install.php","ip_address":"127.0.0.1 (TEMP DATA)"}');