@extends('layouts.user_layout')

@section('title' , 'Contact')

@section('content')
    <!--// Main Content \\-->
    <div class="motivz-main-content motivz-contactfull">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <br>
                        @endif
                        <div class="contact-heading">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Contact Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Terms of Use</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Privacy Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="guidelines-tab" data-toggle="tab" href="#guidelines" role="tab" aria-controls="guidelines" aria-selected="false">Job Posting Guidelines</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- <div class="contact-heading">
                                    <p>MyMotivz is always open to hearing from our clients and candidates. We understand that no one knows how to serve you better  than yourself, and we are always ready to learn how we can serve you. It’s part of our desire to ensure quality and excellent services. <strong>Contact us today!</strong></p>
                                </div> -->
                                <div class="contact-form-wrapper">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="contact-information">
                                                <h2>Contact Information</h2>
                                                <ul class="">
                                                    <li><i class="fa fa-globe"></i> <p>1968 S. Coast Hwy, Suite 2164 Laguna Beach, CA 92651</p></li>
                                                    <li><i class="fa fa-phone"></i> <a href="tel:+9492719102">+949-271-9102</a></li>
                                                    <li><i class="fa fa-envelope"></i> <a href="mailto:info@mymotivz.com">info@mymotivz.com</a></li>
                                                </ul>
                                                <div class="social-x">
                                                    <a href="https://www.facebook.com/" target="_blank" class="fa fa-facebook"></a>
                                                    <a href="https://www.instagram.com/" target="_blank" class="fa fa-instagram"></a>
                                                    <a href="https://www.twitter.com/" target="_blank" class="fa fa-twitter"></a>
                                                    <a href="https://www.youtube.com/" target="_blank" class="fa fa-youtube"></a>
                                                </div>
                                            </div>
                                            <!-- <div class="contact-sidecontent">
                                                <h3>Follow us on social media</h3>
                                                <ul>
                                                    <li><a href="https://www.facebook.com/" target="_blank" class="fa fa-facebook"></a></li>
                                                    <li><a href="https://www.instagram.com/" target="_blank" class="fa fa-instagram"></a></li>
                                                    <li><a href="https://www.youtube.com/" target="_blank" class="fa fa-youtube"></a></li>
                                                </ul>
                                            </div> -->
                                        </div>
                                        <div class="col-md-10">
                                            <!-- <h2>Questions? Contact us today.</h2> -->
                                            <form action="{{route('user.contact.mail')}}" method="post" enctype="multipart/form-data" id="contact_form" name="contact_form">
                                                <h2>Send us a Message</h2>
                                                @csrf
                                                <ul>
                                                    <li>
                                                        <label>Full Name</label>
                                                        <input type="text" name="name" placeholder="" class="form-control"  value="{{old('name')}}">
                                                        @error('name')
                                                        <label for="" class="error">{{$message}}</label>
                                                        @enderror
                                                    </li>
                                                    <li>
                                                        <label>Email Address</label>
                                                        <input type="text" name="email" placeholder="" class="form-control"  value="{{old('email')}}">
                                                        @error('email')
                                                        <label for="" class="error">{{$message}}</label>
                                                        @enderror
                                                    </li>
                                                    <li>
                                                        <label>Phone Number</label>
                                                        <input type="text" name="phone" id="phone" placeholder="" class="form-control"  value="{{old('phone')}}">
                                                        @error('phone')
                                                        <label for="" class="error">{{$message}}</label>
                                                        @enderror
                                                    </li>
                                                    <li>
                                                        <label>Subject</label>
                                                        <select name="subject" class="form-control">
							    <option selected hidden>Select Subject</option>
                                                            <option value="My Account">My Account</option>
                                                            <option value="Job Application">Job Application</option>
                                                            <option value="Resume & Cover Letter">Resume & Cover Letter</option>
                                                            <option value="Recruiting Services">Recruiting Services</option>
                                                            <option value="Post a Job">Post a Job</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        @error('subject')
                                                        <label for="" class="error">{{$message}}</label>
                                                        @enderror
                                                    </li>
                                                    <li class="full">
                                                        <label>Message</label>
                                                        <textarea name="message" placeholder="" class="form-control">{{old('message')}}</textarea>
                                                        @error('message')
                                                        <label for="" class="error">{{$message}}</label>
                                                        @enderror
                                                    </li>
                                                    <li class="full center">
                                                        <div style="display: inline-block;" class="g-recaptcha" name="recaptcha" data-sitekey="6LdYXAcaAAAAAO90Yzvo2DKDepyCc-g_-HU-N2rL"></div>
                                                        @error('g-recaptcha-response')
                                                        <label for="" class="error">{{$message}}</label>
                                                        @enderror
                                                    </li>
                                                    <li class="full center"><input type="submit" value="Submit" class="submit"></li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="terms-of-use">
                                    <section>
                                        <h2>Agreement between User and www.mymotivz.com </h2>
                                        <p>Welcome to www.mymotivz.com. The www.mymotivz.com website (the "Site") is comprised of various web pages operated by MyMotivz, LLC. www.mymotivz.com is offered to you conditioned on your acceptance without modification of the terms, conditions, and notices contained herein (the "Terms"). Your use of www.mymotivz.com constitutes your agreement to all such Terms. Please read these terms carefully, and keep a copy of them for your reference. </p>
                                        <p><a href="www.mymotivz.com">www.mymotivz.com</a> is a Job Board and Employment Agency Site. </p>
                                        <p>We offer staffing and recruiting services for employers nationwide. In addition, we have a dedicated career development that specialize in helping job seekers with resume building, career guidance, job search assistance, and advanced interview preparation with solid tips and tricks for overcoming challenging interview questions. </p>
                                    </section>
                                    <section>
                                        <h2>Privacy</h2>
                                        <p>Your use of www.mymotivz.com is subject to MyMotivz, LLC's Privacy Policy. Please review our Privacy Policy, which also governs the Site and informs users of our data collection practices. </p>
                                    </section>
                                    <section>
                                        <h2>Electronic Communications </h2>
                                        <p>Visiting www.mymotivz.com or sending emails to MyMotivz, LLC constitutes electronic communications. You consent to receive electronic communications and you agree that all agreements, notices, disclosures and other communications that we provide to you electronically, via email and on the Site, satisfy any legal requirement that such communications be in writing. </p>
                                    </section>
                                    <section>
                                        <h2>Your Account </h2>
                                        <p>If you use this site, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. You may not assign or otherwise transfer your account to any other person or entity. You acknowledge that MyMotivz, LLC is not responsible for third party access to your account that results from theft or misappropriation of your account. MyMotivz, LLC and its associates reserve the right to refuse or cancel service, terminate accounts, or remove or edit content in our sole discretion. </p>
                                    </section>
                                    <section>
                                        <h2>Children Under Thirteen </h2>
                                        <p>MyMotivz, LLC does not knowingly collect, either online or offline, personal information from persons under the age of thirteen. If you are under 18, you may use www.mymotivz.com only with permission of a parent or guardian. </p>
                                    </section>
                                    <section>
                                        <h2>Links to Third Party Sites/Third Party Services </h2>
                                        <p>www.mymotivz.com may contain links to other websites ("Linked Sites"). The Linked Sites are not under the control of MyMotivz, LLC and MyMotivz, LLC is not responsible for the contents of any Linked Site, including without limitation any link contained in a Linked Site, or any changes or updates to a Linked Site. MyMotivz, LLC is providing these links to you only as a convenience, and the inclusion of any link does not imply endorsement by MyMotivz, LLC of the site or any association with its operators. </p>
                                        <p>Certain services made available via www.mymotivz.com are delivered by third party sites and organizations. By using any product, service or functionality originating from the www.mymotivz.com domain, you hereby acknowledge and consent that MyMotivz, LLC may share such information and data with any third party with whom MyMotivz, LLC has a contractual relationship to provide the requested product, service or functionality on behalf of www.mymotivz.com users and customers.</p>
                                    </section>
                                    <section>
                                        <h2>No Unlawful or Prohibited Use/Intellectual Property </h2>
                                        <p>You are granted a non-exclusive, non-transferable, revocable license to access and use www.mymotivz.com strictly in accordance with these terms of use. As a condition of your use of the Site, you warrant to MyMotivz, LLC that you will not use the Site for any purpose that is unlawful or prohibited by these Terms. You may not use the Site in any manner which could damage, disable, overburden, or impair the Site or interfere with any other party's use and enjoyment of the Site. You may not obtain or attempt to obtain any materials or information through any means not intentionally made available or provided for through the Site. </p>
                                        <p>All content included as part of the Service, such as text, graphics, logos, images, as well as the compilation thereof, and any software used on the Site, is the property of MyMotivz, LLC or its suppliers and protected by copyright and other laws that protect intellectual property and proprietary rights. You agree to observe and abide by all copyright and other proprietary notices, legends or other restrictions contained in any such content and will not make any changes thereto. </p>
                                        <p>You will not modify, publish, transmit, reverse engineer, participate in the transfer or sale, create derivative works, or in any way exploit any of the content, in whole or in part, found on the Site. MyMotivz, LLC content is not for resale. Your use of the Site does not entitle you to make any unauthorized use of any protected content, and in particular you will not delete or alter any proprietary rights or attribution notices in any content. You will use protected content solely for your personal use, and will make no other use of the content without the express written permission of MyMotivz, LLC and the copyright owner. You agree that you do not acquire any ownership rights in any protected content. We do not grant you any licenses, express or implied, to the intellectual property of MyMotivz, LLC or our licensors except as expressly authorized by these Terms. </p>
                                    </section>
                                    <section>
                                        <h2>Use of Communication Services </h2>
                                        <p>The Site may contain bulletin board services, chat areas, news groups, forums, communities, personal web pages, calendars, and/or other message or communication facilities designed to enable you to communicate with the public at large or with a group (collectively, "Communication Services"). You agree to use the Communication Services only to post, send and receive messages and material that are proper and related to the particular Communication Service. </p>
                                        <p>By way of example, and not as a limitation, you agree that when using a Communication Service, you will not: defame, abuse, harass, stalk, threaten or otherwise violate the legal rights (such as rights of privacy and publicity) of others; publish, post, upload, distribute or disseminate any inappropriate, profane, defamatory, infringing, obscene, indecent or unlawful topic, name, material or information; upload files that contain software or other material protected by intellectual property laws (or by rights of privacy of publicity) unless you own or control the rights thereto or have received all necessary consents; upload files that contain viruses, corrupted files, or any other similar software or programs that may damage the operation of another's computer; advertise or offer to sell or buy any goods or services for any business purpose, unless such Communication Service specifically allows such messages; conduct or forward surveys, contests, pyramid schemes or chain letters; download any file posted by another user of a Communication Service that you know, or reasonably should know, cannot be legally distributed in such manner; falsify or delete any author attributions, legal or other proper notices or proprietary designations or labels of the origin or source of software or other material contained in a file that is uploaded; restrict or inhibit any other user from using and enjoying the Communication Services; violate any code of conduct or other guidelines which may be applicable for any particular Communication Service; harvest or otherwise collect information about others, including e-mail addresses, without their consent; violate any applicable laws or regulations. </p>
                                        <p>MyMotivz, LLC has no obligation to monitor the Communication Services. However, MyMotivz, LLC reserves the right to review materials posted to a Communication Service and to remove any materials in its sole discretion. MyMotivz, LLC reserves the right to terminate your access to any or all of the Communication Services at any time without notice for any reason whatsoever. </p>
                                        <p>MyMotivz, LLC reserves the right at all times to disclose any information as necessary to satisfy any applicable law, regulation, legal process or governmental request, or to edit, refuse to post or to remove any information or materials, in whole or in part, in MyMotivz, LLC's sole discretion. </p>
                                        <p>Always use caution when giving out any personally identifying information about yourself or your children in any Communication Service. MyMotivz, LLC does not control or endorse the content, messages or information found in any Communication Service and, therefore, MyMotivz, LLC specifically disclaims any liability with regard to the Communication Services and any actions resulting from your participation in any Communication Service. Managers and hosts are not authorized MyMotivz, LLC spokespersons, and their views do not necessarily reflect those of MyMotivz, LLC. </p>
                                        <p>Materials uploaded to a Communication Service may be subject to posted limitations on usage, reproduction and/or dissemination. You are responsible for adhering to such limitations if you upload the materials. </p>
                                    </section>
                                    <section>
                                        <h2>Materials Provided to www.mymotivz.com or Posted on Any MyMotivz, LLC Web Page </h2>
                                        <p>MyMotivz, LLC does not claim ownership of the materials you provide to www.mymotivz.com (including feedback and suggestions) or post, upload, input or submit to any MyMotivz, LLC Site or our associated services (collectively "Submissions"). However, by posting, uploading, inputting, providing or submitting your Submission you are granting MyMotivz, LLC, our affiliated companies and necessary sublicensees permission to use your Submission in connection with the operation of their Internet businesses including, without limitation, the rights to: copy, distribute, transmit, publicly display, publicly perform, reproduce, edit, translate and reformat your Submission; and to publish your name in connection with your Submission. </p>
                                        <p>No compensation will be paid with respect to the use of your Submission, as provided herein. MyMotivz, LLC is under no obligation to post or use any Submission you may provide and may remove any Submission at any time in MyMotivz, LLC's sole discretion. </p>
                                        <p>By posting, uploading, inputting, providing or submitting your Submission you warrant and represent that you own or otherwise control all of the rights to your Submission as described in this section including, without limitation, all the rights necessary for you to provide, post, upload, input or submit the Submissions.</p>
                                    </section>
                                    <section>
                                        <h2>International Users </h2>
                                        <p>The Service is controlled, operated and administered by MyMotivz, LLC from our offices within the USA. If you access the Service from a location outside the USA, you are responsible for compliance with all local laws. You agree that you will not use the MyMotivz, LLC Content accessed through www.mymotivz.com in any country or in any manner prohibited by any applicable laws, restrictions or regulations. </p>
                                    </section>
                                    <section>
                                        <h2>Indemnification </h2>
                                        <p>You agree to indemnify, defend and hold harmless MyMotivz, LLC, its officers, directors, employees, agents and third parties, for any losses, costs, liabilities and expenses (including reasonable attorney's fees) relating to or arising out of your use of or inability to use the Site or services, any user postings made by you, your violation of any terms of this Agreement or your violation of any rights of a third party, or your violation of any applicable laws, rules or regulations. MyMotivz, LLC reserves the right, at its own cost, to assume the exclusive defense and control of any matter otherwise subject to indemnification by you, in which event you will fully cooperate with MyMotivz, LLC in asserting any available defenses. </p>
                                    </section>
                                    <section>
                                        <h2>Arbitration </h2>
                                        <p>In the event the parties are not able to resolve any dispute between them arising out of or concerning these Terms and Conditions, or any provisions hereof, whether in contract, tort, or otherwise at law or in equity for damages or any other relief, then such dispute shall be resolved only by final and binding arbitration pursuant to the Federal Arbitration Act, conducted by a single neutral arbitrator and administered by the American Arbitration Association, or a similar arbitration service selected by the parties, in a location mutually agreed upon by the parties. The arbitrator's award shall be final, and judgment may be entered upon it in any court having jurisdiction. In the event that any legal or equitable action, proceeding or arbitration arises out of or concerns these Terms and Conditions, the prevailing party shall be entitled to recover its costs and reasonable attorney's fees. The parties agree to arbitrate all disputes and claims in regards to these Terms and Conditions or any disputes arising as a result of these Terms and Conditions, whether directly or indirectly, including Tort claims that are a result of these Terms and Conditions. The parties agree that the Federal Arbitration Act governs the interpretation and enforcement of this provision. The entire dispute, including the scope and enforceability of this arbitration provision shall be determined by the Arbitrator. This arbitration provision shall survive the termination of these Terms and Conditions. </p>
                                    </section>
                                    <section>
                                        <h2>Class Action Waiver </h2>
                                        <p>Any arbitration under these Terms and Conditions will take place on an individual basis; class arbitrations and class/representative/collective actions are not permitted. THE PARTIES AGREE THAT A PARTY MAY BRING CLAIMS AGAINST THE OTHER ONLY IN EACH'S INDIVIDUAL CAPACITY, AND NOT AS A PLAINTIFF OR CLASS MEMBER IN ANY PUTATIVE CLASS, COLLECTIVE AND/ OR REPRESENTATIVE PROCEEDING, SUCH AS IN THE FORM OF A PRIVATE ATTORNEY GENERAL ACTION AGAINST THE OTHER. Further, unless both you and MyMotivz, LLC agree otherwise, the arbitrator may not consolidate more than one person's claims, and may not otherwise preside over any form of a representative or class proceeding. </p>
                                    </section>
                                    <section>
                                        <h2>Liability Disclaimer </h2>
                                        <p>THE INFORMATION, SOFTWARE, PRODUCTS, AND SERVICES INCLUDED IN OR AVAILABLE THROUGH THE SITE MAY INCLUDE INACCURACIES OR TYPOGRAPHICAL ERRORS. CHANGES ARE PERIODICALLY ADDED TO THE INFORMATION HEREIN. MYMOTIVZ, LLC AND/OR ITS SUPPLIERS MAY MAKE IMPROVEMENTS AND/OR CHANGES IN THE SITE AT ANY TIME. </p>
                                        <p>MYMOTIVZ, LLC AND/OR ITS SUPPLIERS MAKE NO REPRESENTATIONS ABOUT THE SUITABILITY, RELIABILITY, AVAILABILITY, TIMELINESS, AND ACCURACY OF THE INFORMATION, SOFTWARE, PRODUCTS, SERVICES AND RELATED GRAPHICS CONTAINED ON THE SITE FOR ANY PURPOSE. TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, ALL SUCH INFORMATION, SOFTWARE, PRODUCTS, SERVICES AND RELATED GRAPHICS ARE PROVIDED "AS IS" WITHOUT WARRANTY OR CONDITION OF ANY KIND. MYMOTIVZ, LLC AND/OR ITS SUPPLIERS HEREBY DISCLAIM ALL WARRANTIES AND CONDITIONS WITH REGARD TO THIS INFORMATION, SOFTWARE, PRODUCTS, SERVICES AND RELATED GRAPHICS, INCLUDING ALL IMPLIED WARRANTIES OR CONDITIONS OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT. </p>
                                        <p>TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, IN NO EVENT SHALL MYMOTIVZ, LLC AND/OR ITS SUPPLIERS BE LIABLE FOR ANY DIRECT, INDIRECT, PUNITIVE, INCIDENTAL, SPECIAL, CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER INCLUDING, WITHOUT LIMITATION, DAMAGES FOR LOSS OF USE, DATA OR PROFITS, ARISING OUT OF OR IN ANY WAY CONNECTED WITH THE USE OR PERFORMANCE OF THE SITE, WITH THE DELAY OR INABILITY TO USE THE SITE OR RELATED SERVICES, THE PROVISION OF OR FAILURE TO PROVIDE SERVICES, OR FOR ANY INFORMATION, SOFTWARE, PRODUCTS, SERVICES AND RELATED GRAPHICS OBTAINED THROUGH THE SITE, OR OTHERWISE ARISING OUT OF THE USE OF THE SITE, WHETHER BASED ON CONTRACT, TORT, NEGLIGENCE, STRICT LIABILITY OR OTHERWISE, EVEN IF MYMOTIVZ, LLC OR ANY OF ITS SUPPLIERS HAS BEEN ADVISED OF THE POSSIBILITY OF DAMAGES. BECAUSE SOME STATES/JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, THE ABOVE LIMITATION MAY NOT APPLY TO YOU. IF YOU ARE DISSATISFIED WITH ANY PORTION OF THE SITE, OR WITH ANY OF THESE TERMS OF USE, YOUR SOLE AND EXCLUSIVE REMEDY IS TO DISCONTINUE USING THE SITE. </p>
                                    </section>
                                    <section>
                                        <h2>Termination/Access Restriction </h2>
                                        <p>MyMotivz, LLC reserves the right, in its sole discretion, to terminate your access to the Site and the related services or any portion thereof at any time, without notice. To the maximum extent permitted by law, this agreement is governed by the laws of the State of California and you hereby consent to the exclusive jurisdiction and venue of courts in California in all disputes arising out of or relating to the use of the Site. Use of the Site is unauthorized in any jurisdiction that does not give effect to all provisions of these Terms, including, without limitation, this section. </p>
                                        <p>You agree that no joint venture, partnership, employment, or agency relationship exists between you and MyMotivz, LLC as a result of this agreement or use of the Site. MyMotivz, LLC's performance of this agreement is subject to existing laws and legal process, and nothing contained in this agreement is in derogation of MyMotivz, LLC's right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by MyMotivz, LLC with respect to such use. If any part of this agreement is determined to be invalid or unenforceable pursuant to applicable law including, but not limited to, the warranty disclaimers and liability limitations set forth above, then the invalid or unenforceable provision will be deemed superseded by a valid, enforceable provision that most closely matches the intent of the original provision and the remainder of the agreement shall continue in effect. </p>
                                        <p>Unless otherwise specified herein, this agreement constitutes the entire agreement between the user and MyMotivz, LLC with respect to the Site and it supersedes all prior or contemporaneous communications and proposals, whether electronic, oral or written, between the user and MyMotivz, LLC with respect to the Site. A printed version of this agreement and of any notice given in electronic form shall be admissible in judicial or administrative proceedings based upon or relating to this agreement to the same extent and subject to the same conditions as other business documents and records originally generated and maintained in printed form. It is the express wish to the parties that this agreement and all related documents be written in English. </p>
                                    </section>
                                    <section>
                                        <h2>Changes to Terms </h2>
                                        <p>MyMotivz, LLC reserves the right, in its sole discretion, to change the Terms under which www.mymotivz.com is offered. The most current version of the Terms will supersede all previous versions. MyMotivz, LLC encourages you to periodically review the Terms to stay informed of our updates. </p>
                                    </section>
                                    <section>
                                        <h2>Contact Us </h2>
                                        <p>MyMotivz, LLC welcomes your questions or comments regarding the Terms: </p>
                                        <p>MyMotivz, LLC 1968 S. Coast Hwy, Suite 2164 <br> Laguna Beach, California 92651 </p>
                                        <p><strong>Email Address:</strong> <a href="mailto:info@mymotivz.com">info@mymotivz.com</a> </p>
                                        <p><strong>Telephone number:</strong> <a href="tel:(949) 271-9102">(949) 271-9102</a> </p>
                                        <p>Effective as of October 30, 2020 </p>
                                    </section>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="terms-of-use">
                                    <p>Protecting your private information is our priority. This Statement of Privacy applies to www.mymotivz.com and MyMotivz, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to MyMotivz, LLC include www.mymotivz.com. The MyMotivz, LLC website is a www.mymotivz.com is a Job Board and Employment Agency site. By using the MyMotivz, LLC website, you consent to the data practices described in this statement. </p>
                                    <section>
                                        <h2>Collection of your Personal Information </h2>
                                        <p>In order to better provide you with products and services offered on our Site, MyMotivz, LLC may collect personally identifiable information, such as your: </p>
                                        <ul>
                                            <li>First and Last Name </li>
                                            <li>Mailing Address </li>
                                            <li>E-mail Address </li>
                                            <li>Phone Number </li>
                                            <li>Employer </li>
                                            <li>Job Title </li>
                                            <li>Resume </li>
                                        </ul>
                                        <p>We do not collect any personal information about you unless you voluntarily provide it to us. However, you may be required to provide certain personal information to us when you elect to use certain products or services available on the Site. These may include: (a) registering for an account on our Site; (b) entering a sweepstakes or contest sponsored by us or one of our partners; (c) signing up for special offers from selected third parties; (d) sending us an email message; (e) submitting your credit card or other payment information when ordering and purchasing products and services on our Site. To wit, we will use your information for, but not limited to, communicating with you in relation to services and/or products you have requested from us. We also may gather additional personal or non-personal information in the future. </p>
                                    </section>
                                    <section>
                                        <h2>Use of your Personal Information </h2>
                                        <p>MyMotivz, LLC collects and uses your personal information to operate its website(s) and deliver the services you have requested. </p>
                                        <p>MyMotivz, LLC may also use your personally identifiable information to inform you of other products or services available from MyMotivz, LLC and its affiliates. </p>
                                    </section>
                                    <section>
                                        <h2>Sharing Information with Third Parties </h2>
                                        <p>MyMotivz, LLC does not sell, rent or lease its customer lists to third parties. </p>
                                        <p>MyMotivz, LLC may share data with trusted partners to help perform statistical analysis, send you email or postal mail, provide customer support, or arrange for deliveries. All such third parties are prohibited from using your personal information except to provide these services to MyMotivz, LLC, and they are required to maintain the confidentiality of your information. </p>
                                        <p>MyMotivz, LLC may disclose your personal information, without notice, if required to do so by law or in the good faith belief that such action is necessary to: (a) conform to the edicts of the law or comply with legal process served on MyMotivz, LLC or the site; (b) protect and defend the rights or property of MyMotivz, LLC; and/or (c) act under exigent circumstances to protect the personal safety of users of MyMotivz, LLC, or the public. </p>
                                    </section>
                                    <section>
                                        <h2>Tracking User Behavior </h2>
                                        <p>MyMotivz, LLC may keep track of the websites and pages our users visit within MyMotivz, LLC, in order to determine what MyMotivz, LLC services are the most popular. This data is used to deliver customized content and advertising within MyMotivz, LLC to customers whose behavior indicates that they are interested in a particular subject area. </p>
                                    </section>
                                    <section>
                                        <h2>Automatically Collected Information </h2>
                                        <p>Information about your computer hardware and software may be automatically collected by MyMotivz, LLC. This information can include: your IP address, browser type, domain names, access times and referring website addresses. This information is used for the operation of the service, to maintain quality of the service, and to provide general statistics regarding use of the MyMotivz, LLC website. </p>
                                    </section>
                                    <section>
                                        <h2>Use of Cookies </h2>
                                        <p>The MyMotivz, LLC website may use "cookies" to help you personalize your online experience. A cookie is a text file that is placed on your hard disk by a web page server. Cookies cannot be used to run programs or deliver viruses to your computer. Cookies are uniquely assigned to you, and can only be read by a web server in the domain that issued the cookie to you. </p>
                                        <p>One of the primary purposes of cookies is to provide a convenience feature to save you time. The purpose of a cookie is to tell the Web server that you have returned to a specific page. For example, if you personalize MyMotivz, LLC pages, or register with MyMotivz, LLC site or services, a cookie helps MyMotivz, LLC to recall your specific information on subsequent visits. This simplifies the process of recording your personal information, such as billing addresses, shipping addresses, and so on. When you return to the same MyMotivz, LLC website, the information you previously provided can be retrieved, so you can easily use the MyMotivz, LLC features that you customized. </p>
                                        <p>You have the ability to accept or decline cookies. Most Web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. If you choose to decline cookies, you may not be able to fully experience the interactive features of the MyMotivz, LLC services or websites you visit. </p>
                                    </section>
                                    <section>
                                        <h2>Links </h2>
                                        <p>This website contains links to other sites. Please be aware that we are not responsible for the content or privacy practices of such other sites. We encourage our users to be aware when they leave our site and to read the privacy statements of any other site that collects personally identifiable information. </p>
                                    </section>
                                    <section>
                                        <h2>Security of your Personal Information </h2>
                                        <p>MyMotivz, LLC secures your personal information from unauthorized access, use, or disclosure. <br> MyMotivz, LLC uses the following methods for this purpose: </p>
                                        <p>-  SSL Protocol </p>
                                        <p>When personal information (such as a credit card number) is transmitted to other websites, it is protected through the use of encryption, such as the Secure Sockets Layer (SSL) protocol. </p>
                                        <p>We strive to take appropriate security measures to protect against unauthorized access to or alteration of your personal information. Unfortunately, no data transmission over the Internet or any wireless network can be guaranteed to be 100% secure. As a result, while we strive to protect your personal information, you acknowledge that: (a) there are security and privacy limitations inherent to the Internet which are beyond our control; and (b) security, integrity, and privacy of any and all information and data exchanged between you and us through this Site cannot be guaranteed. </p>
                                    </section>
                                    <section>
                                        <h2>Right to Deletion </h2>
                                        <p>Subject to certain exceptions set out below, on receipt of a verifiable request from you, we will: </p>
                                        <ul>
                                            <li>Delete your personal information from our records; and </li>
                                            <li>Direct any service providers to delete your personal information from their records. </li>
                                        </ul>
                                        <p>Please note that we may not be able to comply with requests to delete your personal information if it is necessary to: </p>
                                        <ul>
                                            <li>Complete the transaction for which the personal information was collected, fulfill the terms of a written warranty or product recall conducted in accordance with federal law, provide a good or service requested by you, or reasonably anticipated within the context of our ongoing business relationship with you, or otherwise perform a contract between you and us; </li>
                                            <li>Detect security incidents, protect against malicious, deceptive, fraudulent, or illegal activity; or prosecute those responsible for that activity; </li>
                                            <li>Debug to identify and repair errors that impair existing intended functionality; </li>
                                            <li>Exercise free speech, ensure the right of another consumer to exercise his or her right of free speech, or exercise another right provided for by law; </li>
                                            <li>Comply with the California Electronic Communications Privacy Act; </li>
                                            <li>Engage in public or peer-reviewed scientific, historical, or statistical research in the public interest that adheres to all other applicable ethics and privacy laws, when our deletion of the information is likely to render impossible or seriously impair the achievement of such research, provided we have obtained your informed consent; </li>
                                            <li>Enable solely internal uses that are reasonably aligned with your expectations based on your relationship with us; </li>
                                            <li>Comply with an existing legal obligation; or </li>
                                            <li>Otherwise use your personal information, internally, in a lawful manner that is compatible with the context in which you provided the information. </li>
                                        </ul>
                                    </section>
                                    <section>
                                        <h2>Children Under Thirteen </h2>
                                        <p>MyMotivz, LLC does not knowingly collect personally identifiable information from children under the age of thirteen. If you are under the age of thirteen, you must ask your parent or guardian for permission to use this website. </p>
                                    </section>
                                    <section>
                                        <h2>E-mail Communications </h2>
                                        <p>From time to time, MyMotivz, LLC may contact you via email for the purpose of providing announcements, promotional offers, alerts, confirmations, surveys, and/or other general communication. In order to improve our Services, we may receive a notification when you open an email from MyMotivz, LLC or click on a link therein. </p>
                                        <p>If you would like to stop receiving marketing or promotional communications via email from MyMotivz, LLC, you may opt out of such communications by Customers may unsubscribe from emails by "replying STOP". </p>
                                    </section>
                                    <section>
                                        <h2>Changes to this Statement </h2>
                                        <p>MyMotivz, LLC reserves the right to change this Privacy Policy from time to time. We will notify you about significant changes in the way we treat personal information by sending a notice to the primary email address specified in your account, by placing a prominent notice on our site, and/or by updating any privacy information on this page. Your continued use of the Site and/or Services available through this Site after such modifications will constitute your: (a) acknowledgment of the modified Privacy Policy; and (b) agreement to abide and be bound by that Policy. </p>
                                    </section>
                                    <section>
                                        <h2>Contact Us </h2>
                                        <p>MyMotivz, LLC welcomes your questions or comments regarding the Terms: </p>
                                        <p>1968 S. Coast Hwy, Suite 2164 <br>Laguna Beach, California 92651 </p>
                                        <p><strong>Email Address:</strong> <a href="mailto:info@mymotivz.com">info@mymotivz.com</a> </p>
                                        <p><strong>Telephone number:</strong> <a href="tel:(949) 271-9102">(949) 271-9102</a> </p>
                                        <p>Effective as of October 30, 2020 </p>
                                    </section>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="guidelines" role="tabpanel" aria-labelledby="guidelines-tab">
                                <div class="terms-of-use">
                                    <section>
                                        <h2>Lorem Ipsum Dummy Tilte</h2>
                                        <p>Welcome to www.mymotivz.com. The www.mymotivz.com website (the "Site") is comprised of various web pages operated by MyMotivz, LLC. www.mymotivz.com is offered to you conditioned on your acceptance without modification of the terms, conditions, and notices contained herein (the "Terms"). Your use of www.mymotivz.com constitutes your agreement to all such Terms. Please read these terms carefully, and keep a copy of them for your reference. </p>
                                        <p><a href="www.mymotivz.com">www.mymotivz.com</a> is a Job Board and Employment Agency Site. </p>
                                        <p>We offer staffing and recruiting services for employers nationwide. In addition, we have a dedicated career development that specialize in helping job seekers with resume building, career guidance, job search assistance, and advanced interview preparation with solid tips and tricks for overcoming challenging interview questions. </p>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@endsection

@section('script')
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script>
    $(document).ready(function(){

        $("#phone").each(function(){
            $(this).on("change keyup paste", function (e) {
                var output,
                    $this = $(this),
                    input = $this.val();

                if(e.keyCode != 8) {
                    input = input.replace(/[^0-9]/g, '');
                    var area = input.substr(0, 3);
                    var pre = input.substr(3, 3);
                    var tel = input.substr(6, 4);
                    if (area.length < 3) {
                        output = "(" + area;
                    } else if (area.length == 3 && pre.length < 3) {
                        output = "(" + area + ")" + " " + pre;
                    } else if (area.length == 3 && pre.length == 3) {
                        output = "(" + area + ")" + " " + pre + "-" + tel;
                    }
                    $this.val(output);
                }
            });
        });

        $("#contact_form").validate({
            ignore:[],
            rules: {

                name: {
                    required: true,
                    lettersonly: true,
                    maxlength: 255,
                },
                email: {
                    required: true,
                    email:true,
                    maxlength: 255,
                },

                phone: {
                    required: true,
                    phonenumber:true,
                    minlength: 14,
                    maxlength: 14,
                },
                subject: {
                    required: true,
                },
                message: {
                    required:true,
                    maxlength: 500,
                },
            },
            // Specify validation error messages
            messages: {
                name: {
                    required: "Name is required.",
                    // lettersonly: "Only letters are allowed in Name.",
                    maxlength: "Name must be less than 255 characters."
                },
                email: {
                    required: "Email is required.",
                    email: "Email is invalid.",

                },
                phone: {
                    required: "Phone number is required.",
                    phonenumber: "Phone number must be in valid format.",
                    minlength: "Phone number must be equal to 14 characters.",
                    maxlength: "Phone number must be equal to 14 characters.",
                },
                subject: {
                    required: "Subject is required.",
                },
                message: {
                    required: "Message is required.",
                    maxlength: "Message must be less than 500 characters long.",
                },

            },

            submitHandler: function(form) {
                form.submit();
            }

        });
        // jQuery.validator.addMethod("lettersonly", function(value, element) {
        //     return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
        // });
        // jQuery.validator.addMethod("phonenumber", function(value, element) {
        //     return this.optional(element) || /^[0-9\-\(\)\s]+$/i.test(value);
        // });

        var segments = window.location.href.split( '/' );
        var segment = segments[4];

        if (segment=='terms-of-use') {
            $("#home").removeClass('show active');
            $("#contact").removeClass('show active');
            $("#profile").addClass('show active');

            $("#home-tab").removeClass('show active');
            $("#contact-tab").removeClass('show active');
            $("#profile-tab").addClass('show active');
        }
        else if(segment=='privacy-policy')
        {
            $("#home").removeClass('show active');
            $("#profile").removeClass('show active');
            $("#contact").addClass('show active');

            $("#home-tab").removeClass('show active');
            $("#contact-tab").addClass('show active');
            $("#profile-tab").removeClass('show active');
        }
    });
</script>


@endsection
