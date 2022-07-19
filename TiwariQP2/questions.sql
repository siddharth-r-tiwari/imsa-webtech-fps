/*Siddharth Tiwari, 11/23/30, questions sql file

    key features:
        creates and populates 'questions' data table
            
*/


/*drop the table if it already exists*/
drop table if exists Questions;

/*create a table containing 7 columns:

    qID - question ID
    question - contents of question
    op_1 - option 1
    op_2 - option 2
    op_3 - option 3
    op_4 - option 4
    correct - the option number that is correct

*/
CREATE TABLE Questions(qID int, question text, op_1 text, op_2 text, op_3 text, op_4 text, correct int);
insert into Questions values(1, "which of these parts of the nervous system encompasses the brain and the spine?", "central nervous system", "peripheral nervous system", "sympathetic nervous system", "somatic nervous system", 1);
insert into Questions values(2, "how long is the refractory period or repolarization of a neuron?", "0.5 milliseconds", "2 milliseconds", "5 milliseconds", "10 milliseconds", 2);
insert into Questions values(3, "which type of bias explains why people tend to overthink unreasonable outcomes of situations?", "overconfidence bias", "belief perseverance", "anchoring bias", "sunk-cost fallacy", 3);
insert into Questions values(4, "which neurotransmitter is associated with the inhibition of pain?", "norepinephrine", "acetylcoline", "glutamate", "endorphins", 4);
insert into Questions values(5, "which neurotransmitter is associated with anxiety reduction and relaxation?", "GABA", "serotonin", "dopamine", "endorphins", 1);
insert into Questions values(6, "where is Broca's Area located in the brain?", "medial occipital lobe", "left frontal lobe", "left temporal lobe", "right temporal lobe", 2);
insert into Questions values(7, "which of these is NOT a hallucinogen?", "lsd", "marijuana", "mdma", "peyote", 3);
insert into Questions values(8, "which method to study the brain utilizes magnetic fields to produce images of brain structure and track blood flow?", "ct/cat", "eeg", "pet", "fMRI", 4);
insert into Questions values(9, "what is the term for *perception without sensation*?", "phantom pain", "hallucination", "placebo pain", "synthesia", 1);
insert into Questions values(10, "what is the term for the *awareness of where ones body parts are located*?", "kinesthesia", "proprioception", "umami", "nociception", 2);
insert into Questions values(11, "which SPECIFIC type of conditioning is observed in the *Little Albert* study conducted by Dr. John Watson?", "operant conditioning", "social learning", "emotional conditioning", "insight learning", 3);
insert into Questions values(12, "which rate of reinforcement has the slowest extinction?", "fixed ratio", "variable ratio", "fixed interval", "variable interval", 4);
insert into Questions values(13, "which type of sensory memory lasts the longest?", "echoic memory", "iconic memory", "implicit memory", "long-term memory", 1);
insert into Questions values(14, "which effect explains why individuals remember the first and last elements of a list better than the elements in the middle?", "encoding specificity principle", "serial-position effect", "Von Restoroff effect", "context-dependent memory", 2);
insert into Questions values(15, "which type of memory error BEST explains why students forget what they have learned over the course of high school and college?", "ineffective encoding", "proactive interference", "retroactive interference", "anterograde amnesia", 3);